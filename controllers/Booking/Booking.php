<?php

class Booking extends Base {

    protected $_form = null;
    protected $_bookingModel = null;
    protected $_view = null;

    public function __construct() {
        parent::__construct();
        $this->_form = new BookingForm();
        $this->_bookingModel = BookingModel::getInstance();
        $this->_view = View::getInstance();
    }
    
    public function index() {

        if('thanks' == $this->_request->getByGet("page")) {
            // thank you page
            $this->thankYou();
        } else if('reservations' == $this->_request->getByGet("page")) {
            // reservation ajax request
            $this->reservations();
        } else {
        
            if($this->_request->isPost()){
                // TODO: pass only nessecery data
                $post = $_POST;
                if(!$this->_form->isValid($post)) {
                    // post, valid data
                    $this->_form->generate("booking-form.tpl", $post);
                } else {                
                    // post, save and redirect
                    $dateStart = DateTime::createFromFormat(DATE_FORMAT, $post['bookingDate']);
                    $dateEnd = clone $dateStart;
                    $dateEnd->modify('+2 hours');
                    $reservationData = $this->_bookingModel->checkReservation($dateStart->format(DATE_FORMAT), $dateEnd->format(DATE_FORMAT), $post['bookingPerson']);

                    $post['tableIds'] = array();
                    $first = null;
                    if(isset($reservationData['tables']) && count($reservationData['tables'])) {
                        $bookingNum = (int)$post['bookingPerson'];
                        while($bookingNum > 0) {
                            $first = array_shift($reservationData['tables']);
                            $post['tableIds'][] = $first[0];
                            $bookingNum -= $first[2];
                        }
                    }

                    // no table
                    if(!count($post['tableIds'])) {
                        $this->_form->addError('Form is reserved.');
                        $this->_form->generate("booking-form.tpl", $post);
                    } else {
                        $this->_bookingModel->insert($post);
                        $this->table = $first;
                        header('Location: index.php/?page=thanks');
                        exit();
                    }
                }
            } else {
                // get, show the form
                $this->_form->generate("booking-form.tpl");
            }
        }

    }

    public function reservations() {
        $date = $this->_request->getByGet('date');
        $this->_view->reservations = $this->_bookingModel->reservationList($date);
        $this->_view->render("reservations.tpl");
        exit();
    }

    public function thankyou() {
        $this->_view->render("thankyou.tpl");
    }
}