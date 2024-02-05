<?php

namespace App\Helpers\PaymentProcessors;

class PayPal extends PaymentProcessor
{
    public function __construct(string $name, string $environment, string $publicKey = null, string $privateKey = null)
    {
        parent::__construct($name, $environment, $publicKey, $privateKey);

        $this->iconFilename = 'paypal.png';
        $this->displayName = 'PayPal';
        $this->js = 'https://www.paypal.com/sdk/js?client-id=' . $this->publicKey . '&currency=EUR';
    }
}
