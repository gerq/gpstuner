<?php

class Base {

    protected $_request = null;
    protected $_validator = null;

    public function __construct() {
        $this->_request = Request::getInstance();
        $this->_validator = Validator::getInstance();
    }
    
    public function getRequest() {
        return $this->_request;
    }

    public function getValidator() {
        return $this->_validator;
    }
    
}