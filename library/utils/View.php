<?php

class View extends Singleton {
	
	protected $_translator = null;

	public function render($template, $data = array()) {		
		$viewPath = $this->getViewPath($template);
		if(is_readable($viewPath)) {
			require_once($viewPath);
		}
	}

	public function getViewPath($template) {
		return VIEW_PATH . "/" . $template;
	}

	public function _($key) {
		$this->_translator = Translator::getInstance();
		return $this->_translator->translate($key);
	}

}
