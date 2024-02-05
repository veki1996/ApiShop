<?php

namespace App\Http\Controllers\PaymentControllers;

use App\Exceptions\PaymentException;
use App\Helpers\CurlHelper;
use App\Helpers\PaymentSettings;
use Laravel\Lumen\Routing\Controller as BaseController;
use stdClass;

class PayPalController extends BaseController
{
    protected $settings;

    /**
     * @throws PaymentException
     */
    public function __construct()
    {
        $this->settings = (new PaymentSettings())->getPaymentProcessor('paypal');

        if (!$this->settings) {
            throw new PaymentException('No PayPal payment processor instance found for this environment', 'PayPal');
        }
    }

    public function getOrder(string $orderId): stdClass
    {
        $apiResponse = CurlHelper::request(
            env('PAYPAL_CHECKOUT_URL') . "/orders/$orderId",
            'GET',
            null,
            [
                'Content-Type: application/json',
                'Authorization: Basic ' . base64_encode($this->settings->publicKey . ':' . $this->settings->privateKey)
            ]
        );

        if ($apiResponse->code !== 200) {
            return (object)['success' => false];
        }

        return (object)['success' => true, 'data' => json_decode($apiResponse->body)];
    }
}
