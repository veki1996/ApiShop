<?php

namespace App\Exceptions;

use App\Helpers\PaymentProcessors\PaymentProcessor;
use Throwable;

class PaymentException extends \Exception
{
    protected $processorName;

    public function __construct(string $message, string $processorName = '', Throwable $previous = null) {
        parent::__construct($message, 0, $previous);

        $this -> processorName = $processorName ?: 'Unknown';
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [$this->processorName]: $this->message\n";
    }
}
