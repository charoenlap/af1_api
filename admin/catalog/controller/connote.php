<?php 
	class ConnoteController extends Controller {
	    public function index() {
	    	$data = array();
	    	$api = $this->model('api');
	    	$data_select = array(
	    		// 'date' => (get('date')?get('date'):date('Y-m-d'))
	    	);
	    	$data['log_connote'] = $api->log_connote($data_select);
	    	$data['status'] = $api->status_connote();
	    	$this->view('connote/index',$data);
	    }
	    public function create(){
	    	$data = array();
	    	$this->view('connote/create',$data);
	    }
	    public function changeStatus(){
	    	$data = array();
	    	$result = array();
	    	if(method_post()){
		    	$select = array(
		    		'id_log_connote'	=> post('id_log_connote'),
					'status'			=> post('status')
		    	);
		    	$result = $this->model('api')->changeStatus($select);
		    }
	    	$this->json($result);
	    }
	}
?>