<?php

namespace App\Helpers\PaymentProcessors;

use App\Helpers\ContentHelper;
use App\Helpers\FeeHelper;

class COD extends PaymentProcessor
{
    public function __construct(string $name, string $environment, string $publicKey = null, string $privateKey = null)
    {
        parent::__construct($name, $environment, $publicKey, $privateKey);

        $this->iconFilename = 'safe-payments.png';
        $this->displayName = ContentHelper::staticText('codPaymentAmount', ['codCost' => number_format((new FeeHelper()) -> codCost(), 2) . env('CURRENCY')]);
        $this->default = true;  // TODO: Add ability in Zoho to define this, then forward here
    }
}
