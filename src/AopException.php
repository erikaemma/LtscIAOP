<?php


namespace LTSC\AOP;


use Throwable;

class AopException extends \RuntimeException
{
    protected $emethod;
    protected $etodo;

    public function __construct($emethod = '', $etodo = '', $message = "", $code = 0, Throwable $previous = null) {
        $this->emethod = $emethod;
        $this->etodo = $etodo;
        $message = "When $emethod to $etodo, there is: $message";
        parent::__construct($message, $code, $previous);
    }

    public function getEMethod() {
        return $this->emethod;
    }

    public function getETodo() {
        return $this->etodo;
    }
}