<?php

class Request extends Singleton {
	
	protected $_get = null;
	protected $_post = null;

	public function init() {
		$this->_get = $_GET;
		$this->_post = $_POST;
	}
	
	public function getByGet($name) {
		$return = false;
		if(isset($this->_get[$name])) {
			$return = $this->_filter($this->_get[$name]);
		}
		return $return;
	}

	public function getByPost($name) {
		$return = false;
		if(isset($this->_post[$name])) {
			$return = $this->_filter($this->_post[$name]);
		}
		return $return;
	}
	
	public function isPost() {
		return $_SERVER['REQUEST_METHOD'] == "POST";
	}

	protected function _filter($var) {
		// TODO: html purifier
		return filter_var($var, FILTER_SANITIZE_STRING);
	}

}
