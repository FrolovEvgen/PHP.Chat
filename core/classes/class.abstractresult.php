<?php

namespace WChat;

/**
 * Description of AbstractResult
 *
 * @author Administrator
 */
abstract class AbstractResult {    
    private $result = array();    
    
    protected function setCode($value) {
        $this->setValue("code", $value);
    }
    
    function getCode() {
        $this->getValue("code");
    }
    
    protected function setStatus($value) {
        $this->setValue("status", $value);
    }
    
    function getStatus() {
        $this->getValue("status");
    }
    
    protected function getValue($key) {
        return isset($this->result[$key]) ? $this->result[$key] : '';
    }
    
    protected function setValue($key, $value) {
        $this->result[$key] = $value;
    }
    
    function serialize() {        
        return json_encode($this->result);
    }
}
