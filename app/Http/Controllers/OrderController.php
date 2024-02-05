<?php

namespace App\Http\Controllers;

use App\Helpers\CurlHelper;
use Illuminate\Http\Request;
use App\Helpers\CookieHelper;
use App\Helpers\UserAuthHelper;
use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Http\Controllers\PaymentControllers\PayPalController;

class OrderController extends BaseController
{
    /**
     * Creates order in OMG.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $postData = $request->all();
        CookieHelper::setCookies($request->only(['name', 'telephone', 'address', 'postcode', 'houseno', 'email', 'city']));
        // wrong params
        $postData['address'] .= ' ' . $postData['houseno'];
       
        $formBonus = json_decode($postData['formBonus'], true);

        $postData['formBonus'] = json_encode(
            array_map(
                function ($bonusEntry) {
                    return [
                        'sku'      => $this->setSku($bonusEntry['sku']),
                        'price'    => (string)$bonusEntry['price'],
                        'quantity' => $bonusEntry['quantity'] ?? 1,
                        'discount' => '0'
                    ];
                },
                $formBonus
            )
        );

        $postData['order_items'] = array_map(
            function ($bonusEntry) {
                $prsn = $this->checkSku($bonusEntry['sku']);
                
                $jsonData = [
                    'full_sku' => $this->setSku($bonusEntry['sku']),
                    'quantity' => $bonusEntry['quantity'] ?? 1,
                    'product_name' => $bonusEntry['realName'] ?? '',
                    'discount' => '0'
                ];

                if ($prsn !== null) {
                    $jsonData['prsn'] = $prsn;
                }

                if($bonusEntry['price'] != 0)
                {   
                    $jsonData['price'] =  (string)$bonusEntry['price'];
                }

                return json_encode($jsonData);
            },
            $formBonus
        );
        
        // extra params
        unset($postData['system'], $postData['houseno']);

        // missing params
        $postData['newSystem'] = 1;
        $postData['env'] = 'live';
        $postData['codservice'] = 0;
        $postData['ordersource'] = 'LPF';
        $postData['orderdate'] = date('m/d/Y H:i');
        $postData['ip'] = isset($_SERVER["HTTP_X_REAL_IP"]) ? $_SERVER["HTTP_X_REAL_IP"] : $request->getClientIp();
        $postData['landingpage'] = env('APP_URL');


        if ($postData['paymentmethod'] === 'PP') {
            $postData['paymentmodel'] = 'paypal';
        }

        if ($postData['paymentmethod'] === 'STRIPE') {
            $postData['paymentmethod'] = 'CC';
        }

        $postData['userAgent'] = @$_SERVER['HTTP_USER_AGENT'] ?? '';
        $postData['referrer']  = @$_SERVER['HTTP_REFERER'] ?? '';


        $user = $this->checkUserExistAndSetOrder($request,$postData);

        

        $apiResponse = CurlHelper::request(
            env('OMG_ADAPTER_API_URL'),
            'POST',
            [
                'countryCode' => env('COUNTRY_CODE'),
                'postData' => $postData,
                'domain' => str_replace('https://', '', env('APP_URL')),
            ],
            ['Authorization: ' . env('OMG_ADAPTER_API_KEY')]
        );

        if ($apiResponse->code !== 200) {
            return new JsonResponse(['success' => false, 'message' => 'Could not create order'], $apiResponse->code);
        }

        $responseData = json_decode($apiResponse->body);
        if ($responseData->result !== 'OK') {
            return new JsonResponse(
                ['success' => false, 'message' => 'Could not create order', 'response' => $responseData], 400
            );
        }

        return new JsonResponse([
            'success' => true,
            'message' => 'Order created',
            'response' => $responseData
        ]);
    }

    public function updatePaypalOrder(Request $request): JsonResponse
    {
        $orderId = $request->input('orderId');
        $omgId = $request->input('omgId');
        $domain = $request->input('domain');
        $environment = 'sandbox';  // change when needed

        $paypalResponse = (new PayPalController())->getOrder($orderId);

        if (!$paypalResponse->success) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Could not get the PayPal order'
            ]);
        }

        $invoiceId = @$paypalResponse->data->purchase_units[0]->payments->captures[0]->id;
        if (!$invoiceId) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Could not get the PayPal reference ID'
            ]);
        }

        // update omg order via lpapi2020 call
        $lpApiResponse = CurlHelper::request(
            env('INSTANIO_LP_API_URL') . "?command=sendPayPalPayment&APIKey=" . env('INSTANIO_LP_API_KEY')
            . "&order_id=$omgId&transaction_id=$orderId&transaction_id_second=$invoiceId&domain=$domain&environment=$environment",
            'POST',
        );
        if (@json_decode($lpApiResponse->body)->status !== 'success') {
            return new JsonResponse([
                'success' => false,
                'message' => 'Could not update the order'
            ]);
        }

        // send details to Zoho
        CurlHelper::request(
            env('ZOHO_ORDERS_API_URL'),
            'POST',
            [
                'userBrowser' => 'todo',
                'clientIp' => 'todo',
                'orderData' => $request->input('orderData'),
                'pageUrl' => $request->input('page'),
                'transactionID' => $orderId,
                'invoiceID' => $invoiceId,
                'omgID' => $omgId
            ]
        );

        return new JsonResponse([
            'success' => true,
            'message' => 'Order updated'
        ]);
    }

    public function updateCreditCardOrder(Request $request)
    {
        $orderId = $request->input('orderId');
        $omgId   = $request->input('omgId');
        $domain  = $request->input('domain');

        $lpApiResponse = CurlHelper::request(
            env('INSTANIO_LP_API_URL') . "?command=sendPayment&APIKey=" . env('INSTANIO_LP_API_KEY')
            . "&order_id=$omgId&transaction_id=$orderId&transaction_post&domain=$domain&service_provider=1&status_id=2",
            'POST',
        );
        if (@json_decode($lpApiResponse->body)->status !== 'success') {
            return new JsonResponse([
                'success' => false,
                'message' => 'Could not update the order'
            ]);
        }

        CurlHelper::request(
            env('ZOHO_ORDERS_API_URL'),
            'POST',
            [
                'userBrowser' => 'todo',
                'clientIp'    => 'todo',
                'orderData'   => $request->input('orderData'),
                'pageUrl'     => $request->input('page'),
                'transactionID' => $orderId,
                'invoiceID'   => '',
                'omgID'       => $omgId
            ]
        );

        return new JsonResponse([
            'success' => true,
            'message' => 'Order updated'
        ]);
    }

    public function crossellOrder(Request $request)
    {
        $sHref = $request->input('sHref');
        $data = json_encode($request->input('orderData'));
        $crosselltype  = "crossell";

        $lpApiResponse = CurlHelper::request('https://instanio.com/dev/deamon/kontakt.upsell.deamon.php?token=JU4BF971BFK689CB34N6974N8NRI907907MMXBEV2&sHref='.$sHref.'&order_items='.$data.'&crossell_type='.$crosselltype, 'POST');

        if (@json_decode($lpApiResponse->body)->status !== 'success') {
            return new JsonResponse([
                'success' => false,
                'message' => 'Could not update the order'
            ]);
        }

        return new JsonResponse([
            'success' => true,
            'message' => 'Order updated'
        ]);
    }

    private function checkSku($sku)
    {

        $skuParts = explode('-', $sku);
        if(count($skuParts) > 3)
        {
            $prsn = $skuParts['3'];
            return $prsn;
        }

        return;
    }

    private function setSku($sku)
    {
        $skuParts = explode('-', $sku);

        if (count($skuParts) > 3) {
            array_splice($skuParts, 3, 1);
            $sku = implode('-', $skuParts);
            return $sku;
        }
        
        return $sku;
    }

    private function checkUserExistAndSetOrder($request, $postData)
    {
        $cookieData = ['session_key' => $request->cookie('session_key'.env('BRAND_NAME'))];
        $user = UserAuthHelper::getUser($cookieData, '/info');
        if($user->success != false)
        {   
           $orders = ['session_key' => $cookieData['session_key'], 'order' => json_encode($postData)];
           UserAuthHelper::goZoho($orders, '/orders/set');
        }
        return;
    }

}
