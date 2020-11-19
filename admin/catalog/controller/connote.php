<?php 
	class ConnoteController extends Controller {
	    public function index() {
	    	$data = array();
	    	$this->view('connote/index',$data);
	    }
	}
?>