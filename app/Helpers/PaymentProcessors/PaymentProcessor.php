<?php

namespace App\Helpers\PaymentProcessors;

class PaymentProcessor implements PaymentProcessorInterface
{
    public $name;
    public $privateKey;
    public $publicKey;
    public $environment;
    public $default;

    public $displayName;
    public $iconFilename;

    // Link inclusions
    public $js;
    public $css;

    public function __construct(string $name, string $environment, string $publicKey = null, string $privateKey = null)
    {
        $this->name = $name;
        $this->publicKey = $publicKey;
        $this->privateKey = $privateKey;
        $this->environment = $environment;
        $this->iconFilename='checkout-4.png';
        $this->default = false;
    }
}
