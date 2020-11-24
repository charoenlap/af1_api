<?php 
	class HomeController extends Controller {
	    public function index() {
	    	$data = array();
	    	$data['action'] = route('home');
	    	$data['result'] = '';
	    	if(method_post()){
	    		$employees = $this->model('employees');
	    		$data_check_login = array(
	    			'emp_key' => post('emp_key'),
	    			'password' => post('password')
	    		);
	    		$result_login = $employees->login($data_check_login);
	    		if($result_login['result']=='success'){
	    			$this->setSession('emp_id',$result_login['emp_id']);
	    			$this->setSession('emp_key',$result_login['emp_key']);
	    			$this->redirect('booking') ;
	    		}else{
	    			$data['result'] = $result_login['result'];
	    		}
	    	}
	    	$this->view('home',$data);
	    }
	}
?>