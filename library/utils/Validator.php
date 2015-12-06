<?php

class Validator extends Singleton {

	function isRequired($var) {
		return !empty($var);
	}

	function isInteger($var) {
		return is_numeric($var);
	}
	
	function isValidEmail($email) {
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	function isValidDate($date, $format = DATE_FORMAT) {
		$d = DateTime::createFromFormat($format, $date);
    	return $d && $d->format($format) == $date;
	}

}
