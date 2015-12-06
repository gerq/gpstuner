<?php

class BookingForm extends BaseForm {

    protected $_form = null;    
    protected $_formData = array();
        
    function isValid($data) {
        if(!$this->_validator->isRequired($data["bookingDate"])) {
            $this->addError("bookingDate: booking.form.required");
        } else {
            if(!$this->_validator->isValidDate($data["bookingDate"])) {
                $this->addError("bookingDate: booking.form.date.wrong");
            }
        }
        if(!$this->_validator->isRequired($data["bookingName"])) {
            $this->addError("bookingName: booking.form.required");
        }
        if(!$this->_validator->isRequired($data["bookingAddress"])) {
            $this->addError("bookingAddress: booking.form.required");
        }        
        if(!$this->_validator->isRequired($data["bookingEmail"])) {
            $this->addError("bookingEmail: booking.form.required");
        } else {
            if(!$this->_validator->isValidEmail($data["bookingEmail"])) {
                $this->addError("bookingEmail: booking.form.email.wrong");
            }
        }
        if(!$this->_validator->isRequired($data["bookingPerson"])) {
            $this->addError("bookingPerson: booking.form.required");
        } else {
            if(!$this->_validator->isInteger($data["bookingPerson"])) {
                $this->addError("bookingPerson: booking.form.int");
            }
        }
        
        return $this->hasErrors();
    }

        
}