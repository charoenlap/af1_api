<?php 
	class EmployeesModel extends db {
		public function login($data = array()){
			$result = array();
			$result_text 	= '';
			$emp_key 		= '';
			$id 			= '';

			$sql_employees = "SELECT * FROM employees WHERE emp_key = '".$data['emp_key']."' AND password='".$data['password']."'";
			$result_query = $this->query($sql_employees);
			if($result_query->num_rows > 0){
				$result_text= 'success';
				$id 		= $result_query->row['id'];
				$emp_key 	= $result_query->row['emp_key'];
			}
			$result = array(
				'result' => $result_text,
				'emp_key'=> $emp_key,
				'emp_id' => $id
			);
			return $result;
		}
	}
?>