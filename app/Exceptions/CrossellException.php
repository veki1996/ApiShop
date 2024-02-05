<?php

namespace App\Exceptions;

use App\Helpers\PaymentProcessors\PaymentProcessor;
use Throwable;

class CrossellException extends \Exception
{
    protected $processorName;

    public function __construct(string $message, Throwable $previous = null) {
        parent::__construct($message, 0, $previous);
    }

    public function __toString(): string
    {
        return __CLASS__ . ": $this->message\n";
    }
}
