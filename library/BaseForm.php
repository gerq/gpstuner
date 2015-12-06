<?php

class BaseForm {

    protected $_errors = array();

    public function __construct() {
        $this->_view = View::getInstance();
        $this->_request = Request::getInstance();
        $this->_validator = Validator::getInstance(); 
        $this->_translator = Translator::getInstance();        
    }
    
    public function hasErrors() {
        return empty($this->_errors);
    }
    
    public function addError($error) {
        $this->_errors[] = $this->_translator->translate($error);
    }

    public function getErrors() {
        return $this->_errors;
    }
    
    public function generate($template, $data = array()) {
        $data["errors"] = $this->getErrors();
        $this->_view->render($template, $data);
    }    
}