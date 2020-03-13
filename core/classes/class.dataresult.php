<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace WChat;

/**
 * Description of DataResult
 *
 * @author Administrator
 */
class DataResult extends AbstractResult{
    //put your code here
    /**
     * 
     * @param type $data
     * @return DataResult
     */
    public static function create($data) {
        $instance = new self();
        $instance->setData($data);
        $instance->setCode(0);
        $instance->setStatus(TRUE);
        return $instance;
    }
}
