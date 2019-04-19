<?php


namespace LTSC\AOP;


use SebastianBergmann\CodeCoverage\RuntimeException;
use Throwable;

class CallException extends RuntimeException
{
    protected $callback;
    protected $callType;

    public function __construct($callType = '', $callback = 0, $code = 0, Throwable $previous = null) {
        $this->callType = $callType;
        $this->callback = $callback;
        $message = "When call Type $callType, number $callback, it return false";
        parent::__construct($message, $code, $previous);
    }

    public function getCallback() {
        return $this->callback;
    }

    public function getCallType() {
        return $this->callType;
    }
}