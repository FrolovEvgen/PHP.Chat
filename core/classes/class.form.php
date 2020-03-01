<?php
namespace WChat;

//------------------------------------------------------------------------------
//    DESCRIPTIONS
//------------------------------------------------------------------------------

/**
 * Класс <b>Form</b> -- генерирует форму с полями.
 * <br>
 * @author Frolov E. <frolov@amiriset.com>
 * @created 27.02.2020 21:09
 * @project PHP.Chat
 */
class Form {
    // Метод POST.
    public static $METHOD_POST = "post";
    // Метод GET.
    public static $METHOD_GET = "get";
    //--------------------------------------------------------------------------
    // CONSTRUCTOR
    //--------------------------------------------------------------------------
    /**
     * Создать экземпляр класса.
     * @param string $id ИД формы.
     * @param string $action URL обработки данных.
     * @param string $method Метод отправки POST/GET.
     */
    function __construct(string $id, string $action, string $method=null) {
        $this->id = $id;
        $this->action = $action;
        $this->method = isset($method) ? $method : self::$METHOD_POST;
    }

    //--------------------------------------------------------------------------
    // PUBLIC SECTION
    //--------------------------------------------------------------------------
    /**
     * Добавить заголовок.
     * @param array $fieldConfig Конфигурация поля.
     */
    function appendHeader($fieldConfig) {
        if (!isset($fieldConfig["type"])) {
            $fieldConfig["type"] = "header";
        }
        array_push($this->fields, $fieldConfig);
    }
    
    /**
     * Добавить текстовое поле.
     * @param array $fieldConfig Конфигурация поля.
     */
    function appendInput($fieldConfig) {
        if (!isset($fieldConfig["type"])) {
            $fieldConfig["type"] = "text";
        }
        array_push($this->fields, $fieldConfig);
    }
    
    /**
     * Добавить кнопку к форме.
     * @param array $fieldConfig Конфигурация кнопки.
     */
    function appendSubmit($fieldConfig) {
        if (!isset($fieldConfig["type"])) {
            $fieldConfig["type"] = "header";
        }
        array_push($this->fields, $fieldConfig);
    }

    /**
     * Сгенерировать форму.
     * @param array $errors Ошибки для полей..
     * @return string
     */
    function generateForm($errors=[]) {
        // Заголовок формы.
        $result = '<form';
        $result .= ' id="' . $this->id . '"';
        $result .= ' action="' . $this->action . '"';
        $result .= ' method="' . $this->method . '"';
        $result .= '>';

        // Перебираем поля.
        foreach($this->fields as $field) {
            // Если есть ошибки - добавляем к конфигурации.
            if (isset($errors[$field["id"]])) {
                $field["error"] = $errors[$field["id"]];
            }

            // Перебираем элементы.
            switch ($field["type"]) {
                case ("header"):
                    // Генерируем заголовок.
                    $result  .= $this->createHeader($field);
                    break;
                case ("email"):
                case ("text"):
                case ("password"):
                    // Генерируем текстовое поле.
                    $result  .= $this->createInput($field);
                    break;
                case ("button"):
                    // Генерируем кнопку.
                    $result  .= $this->createButton($field);
                    break;
            }
        }
        // Закрываем форму и выдем ее на отображение.
        return $result . '</form>';
    }

    //--------------------------------------------------------------------------
    // PROTECTED SECTION
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
    // PRIVATE SECTION
    //--------------------------------------------------------------------------

    /**
     * ИД формы.
     * @var string
     */
    private $id;

    /**
     * Метод отправки данных.
     * @var string
     */
    private $method;

    /**
     * URL обработчика данных.
     * @var string
     */
    private $action;

    /**
     * Массив конфигурация полей.
     * @var array
     */
    private $fields = [];

    /**
     * Зоздать заголовок формы.
     * @param array $field Конфигурация заголовка.
     * @return string Сгенерированный элемент.
     */
    private function createHeader(array $field){
        $result = '<div class="form-group">';
        $result .= '<h3>' . $field["text"] . '</h3>';
        $result .= '</div>';

        return $result;
    }

    /**
     * Создаем текстовое поле.
     * @param array $field Конфигурация поля.
     * @return string Сгенерированный элемент.
     */
    private function createInput(array $field) {

        // Если поле с ошибкой, подсвечиваем его.
        if (isset($field["error"])) {
            $result = '<div class="form-group has-error">';            
        } else {
            $result = '<div class="form-group">';
        }
        // Название поля, если есть.
        if (isset($field["label"])) {
            $result .= '<label for="' . $field["id"] . '">';
            $result .= $field["label"];
            // Если поле "Обязательное" - помечаем.
            if (isset($field["required"]) && $field["required"] === true) {
                $result .= '<span>*</span>';
            }        
            $result .= '</label>';
        }
        // Рисуем само текстовое поле.
        $result .= '<input id="' . $field["id"] . '" ';
        $result .= 'class="form-control" ';    
        $result .= 'type="' . $field["type"] . '" ';
        $result .= 'name="' . $field["id"] . '" ';
        $result .= 'value="' . \WChat\Engine::POST($field["id"]) . '" >';
        // Добавляем описание к полю.
        if (isset($field["description"])) {
            $result .= '<small class="form-text text-muted">' . 
                    $field["description"] . '</small>';
        }
        // Отображаем сообщение об ошибке.
        if (isset($field["error"])) {
            $result .= '<small class="form-text text-error">' . 
                    $field["error"] . '</small>';
        }
        $result .= '</div>';    
        return $result;
    }
    
    /**
     * Создаем кнопку.
     * @param array $field Конфигурация элемента.
     * @return string Сгенерированный элемент.
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

}
