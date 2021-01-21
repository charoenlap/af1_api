<?php 
	class ApiModel extends db {
		public function changeStatus($data=array()){
			$result = array();
			$sql = "UPDATE api_log_connote SET connote_status = '".(int)$data['status']."' WHERE id_log_connote=".(int)$data['id_log_connote'];
			$result_query = $this->query($sql);
			return $result_query;
		}
	    public function log_booking($data) {
	    	$result = array();
	    	$column = array();
	    	$where = '';
	    	if(isset($data['date'])){
	    		$where = " WHERE DATE(file_date_create) = '".$date."'";
	    	}
	    	$sql = "SELECT * FROM api_log_booking".$where;
	    	$result_query = $this->query($sql);
	    	foreach($result_query->columns as $val){
	    		$column[] = $val;
	    	}
	    	$result = array(
	    		'data'		=> $result_query->rows,
	    		'columns'	=> $column
	    	);
	    	return $result;
	    }
	    public function log_connote($data) {
	    	$result = array();
	    	$column = array();
	    	$where = '';
	    	if(isset($data['date'])){
	    		$where = " WHERE DATE(file_date_create) = '".$date."'";
	    	}
	    	$sql = "SELECT * FROM api_log_connote 
	    	LEFT JOIN api_connote_status ON api_connote_status.status_id = api_log_connote.connote_status".$where." ORDER BY id_log_connote DESC";
	    	$result_query = $this->query($sql);
	    	foreach($result_query->columns as $val){
	    		$column[] = $val;
	    	}
	    	// var_dump($result_query->rows);
	    	$result = array(
	    		'data'		=> $result_query->rows,
	    		'columns'	=> $column
	    	);
	    	return $result;
	    }
	     public function status_connote() {
	    	$result = array();
	    	$column = array();
	    	$sql = "SELECT * FROM api_connote_status";
	    	$result_query = $this->query($sql);
	    	foreach($result_query->columns as $val){
	    		$column[] = $val;
	    	}
	    	// var_dump($result_query->rows);
	    	$result = array(
	    		'data'		=> $result_query->rows,
	    		'columns'	=> $column
	    	);
	    	return $result;
	    }
	}
?>