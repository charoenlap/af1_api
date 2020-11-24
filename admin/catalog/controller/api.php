<?php 
	class ApiController extends Controller {
	    public function log_booking($data) {
	    	$result = array();
	    	$date = $data['date'];
	    	$sql = "SELECT * FROM api_log_booking WHERE DATE(file_date_create) = '".$date."'";
	    	$result_query = $this->query($sql);
	    	$result = $result_query->rows;
	    	return $result;
	    }
	}
?>