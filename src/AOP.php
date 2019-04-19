<?php


namespace LTSC\AOP;


class AOP
{
    protected $before = [];
    protected $after = [];
    protected $instance = null;

    public function __construct($instance, $before = null, $after = null) {
        $this->setObject($instance);
        if(!is_null($before))
            $this->addBefore($before);
        if(!is_null($after))
            $this->addAfter($after);
    }

    public function setObject($instance) {
        if(is_object($instance))
            $this->instance = $instance;
        else
            throw new AopException('set', 'object', 'not an object');
    }

    public function addBefore($before) {
        if(is_callable($before))
            $this->before[] = $before;
        else
            throw new AopException('add', 'before', 'not a callable');
    }

    public function addAfter($after) {
        if(is_callable($after))
            $this->after[] = $after;
        else
            throw new AopException('add', 'after', 'not a callable');
    }

    protected function callAllBefore($method, $arguments) :void {
        if(!empty($this->before)) {
            foreach($this->before as $index => $callback) {
                if(!call_user_func_array($callback, [$method, $arguments])) {
                    throw new CallException('before', $index);
                }
            }
        }
    }

    protected function callAllAfter($result, $method, $arguments) :void {
        if(!empty($this->after)) {
            foreach($this->after as $index => $callback) {
                if(!call_user_func_array($callback, [$result, $method, $arguments])) {
                    throw new CallException('after', $index);
                }
            }
        }
    }

    protected function call($method, $arguments) {
        if(method_exists($this->instance, $method)) {
            return call_user_func_array([$this->instance, $method], $arguments);
        } else {
            $classname = (new \ReflectionObject($this->instance))->getName();
            throw new AopException('call', $method, "not exist in class $classname");
        }

    }

    public function __call($method, $arguments) {
        $this->callAllBefore($method, $arguments);
        $result = $this->call($method, $arguments);
        $this->callAllAfter($result, $method, $arguments);
        return $result;
    }
}