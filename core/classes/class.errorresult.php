<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace WChat;

/**
 * Description of errorresult
 *
 * @author Administrator
 */
class ErrorResult extends AbstractResult {
    
    /**
     * 
     * @param type $errorMessage
     * @return type
     */
    public static function message($errorMessage) {        
        return self::create(1, $errorMessage);
    }
    
    /**
     * 
     * @param type $code
     * @param type $errorMessage
     * @return type
     */
    public static function create($code, $errorMessage) {
        $instance = new self();
        $instance->setErrorMessage($errorMessage);
        $instance->setCode($code);
        $instance->setStatus(FALSE);
        return $instance;
    }
    
    /**
     * 
     * @return type
     */
    function getErrorMessage() {
        return $this->getValue("errorMessage");
    }
    
    /**
     * 
     * @param type $value
     */
    private function setErrorMessage($value) {
        $this->setValue("errorMessage", $value);
    }

}
