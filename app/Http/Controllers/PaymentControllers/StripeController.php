<?php

namespace App\Http\Controllers\PaymentControllers;

use App\Exceptions\PaymentException;
use App\Helpers\PaymentSettings;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Stripe\StripeClient;

class StripeController extends BaseController
{
    protected $stripeSettings;

    /**
     * @throws PaymentException
     */
    public function __construct()
    {
        $this->stripeSettings = (new PaymentSettings())->getPaymentProcessor('stripe');

        if (!$this->stripeSettings) {
            throw new PaymentException('No Stripe payment processor instance found for this environment', 'Stripe');
        }
    }

    public function createIntent(Request $request): JsonResponse
    {
        $stripeClient = new StripeClient($this->stripeSettings->privateKey);

        $response = $stripeClient->paymentIntents->create(['amount' => (int)($request->json('amount') * 100),
            'currency' => $request->json('currency_code'),
            'payment_method_types' => ['card']]);             // TODO: Find out what these are

        if (!$response->id || !$response->client_secret) {
            return new JsonResponse(['success' => false, 'message' => 'Cannot initialize Stripe intent!']);
        }

        return new JsonResponse(['success' => true,
            'message' => 'Done!',
            'id' => $response->id,
            'client_secret' => $response->client_secret,
            'customer_id' => null]); // TODO: Create customer here or later?
    }

    public function updateAmount(Request $request)
    {
        $stripeClient = new StripeClient($this->stripeSettings->privateKey);

        $response = $stripeClient->paymentIntents->update($request->json('intent_id'), ['amount' => (int)($request->json('amount') * 100)]);

        if (!$response->id || !$response->client_secret) {
            return new JsonResponse(['success' => false, 'message' => 'Cannot update Stripe intent!']);
        }

        return new JsonResponse(['success' => true,
            'message' => 'Done!',
            'id' => $response->id,
            'client_secret' => $response->client_secret,
            'customer_id' => null]);
    }
}
