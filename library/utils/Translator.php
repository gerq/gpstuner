<?php

class Translator extends Singleton {

	protected $_lang = 'hu';

	protected $_translation = array(
        'table.name.1' => array(
            'hu' => '1. asztal',
        ),        
        'table.name.2' => array(
            'hu' => '2. asztal',
        ),        
        'table.name.3' => array(
            'hu' => '3. asztal',
        ),        
        'table.name.4' => array(
            'hu' => '4. asztal',
        ),        
        'table.name.5' => array(
            'hu' => '5. asztal',
        ),        
        'table.name.6' => array(
            'hu' => '6. asztal',
        ),        
        'table.name.7' => array(
            'hu' => '7. asztal',
        ),        
        'table.name.8' => array(
            'hu' => '8. asztal',
        ),        
    	'bookingDate: booking.form.required' => array(
        	'hu' => 'A dátum mező kötelező.',
    	),
    	'bookingDate: booking.form.date.wrong' => array(
        	'hu' => 'Rossz dátum formátum.',
    	),
    	'bookingName: booking.form.required' => array(
        	'hu' => 'A név mező kötelező.',
    	),
    	'bookingAddress: booking.form.required' => array(
        	'hu' => 'A cím mező kötelező.',
    	),
    	'bookingEmail: booking.form.required' => array(
        	'hu' => 'Az email mező kötelező.',
    	),
    	'bookingEmail: booking.form.email.wrong' => array(
        	'hu' => 'Rossz email formátum.',
    	),
        'Form is reserved.' => array(
            'hu' => 'Az időpont már foglalt, válassz másikat.',
        ),
        'booking.title' => array(
            'hu' => 'Asztalfoglalás',
        ),
        'booking.form.title' => array(
            'hu' => 'Foglalás időpontra',
        ),
        'booking.sub.title' => array(
            'hu' => 'Asztalfoglalás',
        ),
        'booking.home' => array(
            'hu' => 'Főoldal',
        ),
        'booking.booking' => array(
            'hu' => 'Foglalás',
        ),
        'booking.form.date' => array(
            'hu' => 'Foglalás ideje',
        ),
        'booking.form.name' => array(
            'hu' => 'Név',
        ),
        'booking.form.email' => array(
            'hu' => 'Email',
        ),
        'booking.form.address' => array(
            'hu' => 'Cím',
        ),
        'booking.form.comment' => array(
            'hu' => 'Megjegyzés',
        ),
        'booking.form.send' => array(
            'hu' => 'Lefoglalom',
        ),
        'booking.top' => array(
            'hu' => '^ fel ^',
        ),
        'booking.thankyou.title' => array(
            'hu' => 'Sikeres foglalás',
        ),
        'booking.success' => array(
            'hu' => 'Köszönjük a foglalást, TODO: email küldés, visszaigazolás, részletes adatok megjelenítése stb.',
        ),
        'booking.back' => array(
            'hu' => 'Vissza',
        ),
        '' => array(
            'hu' => '',
        ),

        


	);

	public function translate($key) {
		if(isset($this->_translation[$key][$this->_lang])){
			return $this->_translation[$key][$this->_lang];
		} else {
			return "*** " . $key . " ***";
		}
	}

	public function setLang($lang) {
		$this->_lang = $lang;
	}

}
