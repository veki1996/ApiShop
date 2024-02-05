<?php

namespace App\Helpers\PaymentProcessors;

use App\Helpers\ContentHelper;

class Stripe extends PaymentProcessor
{
    public function __construct(string $name, string $environment, string $publicKey = null, string $privateKey = null)
    {
        parent::__construct($name, $environment, $publicKey, $privateKey);

        $this->iconFilename = 'cards.png';
        $this->displayName = ContentHelper::staticText('creditCard');
        $this->js = 'https://js.stripe.com/v3/';
    }
}
