<?php
namespace WChat;

/**
 * Description of form
 *
 * @author Administrator
 */
class Form {
    
    public static $METHOD_POST = "post";
    public static $METHOD_GET = "get";
    
    /**
     * 
     * @param string $id     
     * @param string $action
     * @param string $method 
     */
    function __construct($id, $action, $method=null) {
        $this->id = $id;
        $this->action = $action;
        $this->method = isset($method) ? $method : self::$METHOD_POST;
    }
    
    /**
     * 
     * @param array $fieldConfig
     */
    function appendHeader($fieldConfig) {
        if (!isset($fieldConfig["type"])) {
            $fieldConfig["type"] = "header";
        }
        array_push($this->fields, $fieldConfig);
    }
    
    /**
     * 
     * @param array $fieldConfig
     */
    function appendInput($fieldConfig) {
        if (!isset($fieldConfig["type"])) {
            $fieldConfig["type"] = "text";
        }
        array_push($this->fields, $fieldConfig);
    }
    
    /**
     * 
     * @param array $fieldConfig
     */
    function appendSubmit($fieldConfig) {
        if (!isset($fieldConfig["type"])) {
            $fieldConfig["type"] = "header";
        }
        array_push($this->fields, $fieldConfig);
    }
    
    /**
     * 
     * @return string
     */
    function generateForm($errors=[]) {
        
        $result = '<form';
        $result .= ' id="' . $this->id . '"';
        $result .= ' action="' . $this->action . '"';
        $result .= ' method="' . $this->method . '"';
        $result .= '>';
        
        foreach($this->fields as $field) {
            
            if (isset($errors[$field["id"]])) {
                $field["error"] = $errors[$field["id"]];
            }
            
            switch ($field["type"]) {
                case ("header"): 
                    $result  .= $this->createHeader($field);
                    break;
                case ("email"):
                case ("text"):
                case ("password"):
                    $result  .= $this->createInput($field);
                    break;
                case ("button"): 
                    $result  .= $this->createButton($field);
                    break;
            }
        }
        
        return $result . '</form>';
    }
    
    /**
     * 
     * @param array $field
     * @return string
     */
    private function createHeader(array $field){
        $result = '<div class="form-group">';
        $result .= '<h3>' . $field["text"] . '</h3>';
        $result .= '</div>';

        return $result;
    }

    /**
     * 
     * @param array $field
     * @return string
     */
    private function createInput(array $field) {

        if (isset($field["error"])) {
            $result = '<div class="form-group has-error">';            
        } else {
            $result = '<div class="form-group">';
        }       

        if (isset($field["label"])) {
            $result .= '<label for="' . $field["id"] . '">';
            $result .= $field["label"];

            if (isset($field["required"]) && $field["required"] === true) {
                $result .= '<span>*</span>';
            }        
            $result .= '</label>';
        }

        $result .= '<input id="' . $field["id"] . '" ';
        $result .= 'class="form-control" ';    
        $result .= 'type="' . $field["type"] . '" ';
        $result .= 'name="' . $field["id"] . '" ';
        $result .= 'value="' . \WChat\Engine::POST($field["id"]) . '" >';

        if (isset($field["description"])) {
            $result .= '<small class="form-text text-muted">' . 
                    $field["description"] . '</small>';
        }
        
        if (isset($field["error"])) {
            $result .= '<small class="form-text text-error">' . 
                    $field["error"] . '</small>';
        }

        $result .= '</div>';    
        return $result;
    }
    
    /**
     * 
     * @param array $field
     * @return string
     */
    private function createButton(array $field) {
        $result = '<div class="form-group">';
        $result .= '<button id="' . $field["id"] . '" ';
        $result .= 'class="btn-primary" ';  
        $result .= 'type="submit" ';   
        $result .= 'form="' . $this->id . '"  ';   
        $result .= 'value="Submit" ';   
        $result .= '>' . $field["text"] . '</button>';
        $result .= '</div>';

        return $result;
    }

    /**
     * @var string 
     */
    private $id;
    
    /**
     * @var string 
     */
    private $method;
    
    /**
     *
     * @var string 
     */
    private $action;
    
    /**
     * @var array 
     */
    private $fields = [];
}
