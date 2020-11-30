<?php 
	class HomeController extends Controller {
	    public function index() {
	    	$data = array();
	    	$data['emp_id'] = emp_id();
	    	if($data['emp_id']){
	    		$this->redirect('booking');
	    	}else{
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
		    			// echo $result_login['emp_id'];exit();
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
	    public function logout() {
	    	$this->setSession('emp_id','');
	    	// unset($_SESSION['emp_id']);
	    	$this->redirect('home/index');
	    }
	}
?>