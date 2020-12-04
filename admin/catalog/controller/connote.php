<?php 
	class ConnoteController extends Controller {
	    public function index() {
	    	$data = array();
	    	$api = $this->model('api');
	    	$data_select = array(
	    		'date' => (get('date')?get('date'):date('Y-m-d'))
	    	);
	    	$data['log_connote'] = $api->log_connote($data_select);
	    	$this->view('connote/index',$data);
	    }
	    public function create(){
	    	$data = array();
	    	$this->view('connote/create',$data);
	    }
	}
?>