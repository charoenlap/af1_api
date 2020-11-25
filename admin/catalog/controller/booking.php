<?php 
	class BookingController extends Controller {
	    public function index() {
	    	$data = array();
	    	$api = $this->model('api');
	    	$data_select = array(
	    		'date' => (get('date')?get('date'):date('Y-m-d'))
	    	);
	    	$data['log_booking'] = $api->log_booking($data_select);
	    	$this->view('booking/index',$data);
	    }
	    public function create(){
	    	$data = array();
	    	$this->view('booking/create',$data);
	    }
	}
?>