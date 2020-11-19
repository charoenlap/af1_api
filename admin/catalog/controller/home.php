<?php 
	class HomeController extends Controller {
	    public function index() {
	    	$data = array();
	    	if(method_post()){
	    		$this->redirect('booking') ;
	    	}
	    	$this->view('home',$data);
	    }
	}
?>