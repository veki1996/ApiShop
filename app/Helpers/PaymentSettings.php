<?php

namespace App\Helpers;

use App\Helpers\External\ZohoHelper;
use App\Helpers\PaymentProcessors\COD;
use App\Helpers\PaymentProcessors\PaymentProcessor;
use App\Helpers\PaymentProcessors\PayPal;
use App\Helpers\PaymentProcessors\Stripe;
use Illuminate\Support\Facades\Cache;

class PaymentSettings
{
    private $paymentProcessors = [];
    private $classMap = [
        'stripe' => Stripe::class,
        'paypal' => PayPal::class,
        'cod' => COD::class
    ];

    public function __construct()
    {
        if (!Cache::get('payment-settings')) {
            $zh = new ZohoHelper();
            $zh->fetchPaymentSettings();

            // TEMP: used for testing since nothing is added for Pogreska in Zoho
            // $settings = [
            //     [
            //         "details" => [
            //             "stripe_secret_key"      => "sk_live_ba4gJdxpuJktZyuf5SXZDz2m00DXi653Dr",
            //             "stripe_publishable_key" => "pk_live_HKXZcH6lUzS6nTzrCSfLU09w00YbJPE3R1"
            //         ],
            //         "name"    => "stripe",
            //         "env"     => "live"
            //     ],
            //     [
            //         "details" => [
            //             "stripe_secret_key"      => "sk_test_WjQuLcYgzYFoIoYzC6KOlVLM00YIuOxKZs",
            //             "stripe_publishable_key" => "pk_test_du2RXLOfY3gVZx4i72dFYCHA00Rtx4G9dP"
            //         ],
            //         "name"    => "stripe",
            //         "env"     => "dev"
            //     ],
            //     [
            //         "details" => [
            //         ],
            //         "name"    => "cod",
            //         "env"     => null
            //     ]
            // ];

           // Cache::put('payment-settings', $settings, 60 * 60);
        }

        $settings = Cache::get('payment-settings');

        if (!$settings || !count($settings)) {
            // TODO: Throw exception?
        }

        $environment = in_array(env('APP_ENV'), ['prod', 'production', 'live']) ? 'live' : 'dev';

        if(request() -> input('pdev') || ((request() -> server -> get('HTTP_REFERER')) && strpos(request() -> server -> get('HTTP_REFERER'), 'pdev') !== false))
            $environment = 'dev';
      
        foreach ($settings as $paymentProcessor) {

            if (!isset($this->classMap[$paymentProcessor['name']]) || !$this->classMap[$paymentProcessor['name']]) {
                continue;
            }

            $publicKey = null;
            $privateKey = null;

            if (
                in_array($paymentProcessor['name'], ['stripe'])
                && (!$paymentProcessor['details'] || !$paymentProcessor['env'])
            ) {
                continue;
            }

            if ($paymentProcessor['name'] === 'stripe') {
                if ($paymentProcessor['env'] !== $environment) {
                    continue;
                }

                $publicKey = $paymentProcessor['details']['stripe_publishable_key'];
                $privateKey = $paymentProcessor['details']['stripe_secret_key'];

            } elseif ($paymentProcessor['name'] === 'paypal') {
                if ($paymentProcessor['env'] !== ($environment === 'dev' ? 'sandbox' : 'live')) {
                    continue;
                }

                $publicKey = $paymentProcessor['details']['CLIENT_ID'];
                $privateKey = $paymentProcessor['details']['CLIENT_SECRET'];
            }

            $processorClass = $this->classMap[$paymentProcessor['name']];
            $processor = new $processorClass($paymentProcessor['name'], $environment, $publicKey, $privateKey);

            // have COD as first processor
            $paymentProcessor['name'] === 'cod'
                ? array_unshift($this->paymentProcessors, $processor)
                : array_push($this->paymentProcessors, $processor);
        }
    }

    public function getPaymentProcessors(): array
    {
        return $this->paymentProcessors;

    }

    public function getPaymentProcessor(string $name): ?PaymentProcessor
    {
        foreach ($this -> paymentProcessors as $paymentProcessor) {
            if ($paymentProcessor -> name === $name) { return $paymentProcessor; }
        }

        return null;
    }
}
