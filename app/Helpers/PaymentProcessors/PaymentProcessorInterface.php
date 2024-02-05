<?php

namespace App\Helpers\PaymentProcessors;

interface PaymentProcessorInterface
{
    public function __construct(string $name, string $environment, string $publicKey = null, string $privateKey = null);
}
