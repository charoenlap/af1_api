<?php 
	class BookingController extends Controller {
	    public function index() {
	    	$data = array();
	    	$this->view('booking/index',$data);
	    }
	    public function create(){
	    	$data = array();
	    	$this->view('booking/create',$data);
	    }
	}
?>