<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace WChat;

/**
 * Description of MessageResult
 *
 * @author Administrator
 */
class MessageResult extends AbstractResult {
    //put your code here
    
    /**
     * 
     * @param type $message
     * @return MessageResult
     */
    public static function create($message) {
        $instance = new self();
        $instance->setMessage($message);
        $instance->setCode(0);
        $instance->setStatus(TRUE);
        return $instance;
    }
    
    /**
     * 
     * @param type $value
     */
    private function setMessage($value) {
        $this->setValue("message", $value);
    }
    
    /**
     * 
     */
    function getMessage() {
        $this->getValue("message");
    }
}
