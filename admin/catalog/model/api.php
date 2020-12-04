<?php 
	class ApiModel extends db {
	    public function log_booking($data) {
	    	$result = array();
	    	$column = array();
	    	$date = $data['date'];
	    	$sql = "SELECT * FROM api_log_booking WHERE DATE(file_date_create) = '".$date."'";
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
	    	$date = $data['date'];
	    	$sql = "SELECT * FROM api_log_connote WHERE DATE(file_date_create) = '".$date."'";
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