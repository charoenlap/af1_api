<?php
class db{
	public $db;
	// public $check_open;
	function __construct(){
		$this->db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_DB);
		$this->db->query('SET NAMES utf8');
		if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
		    exit();
		}
		$this->db->set_charset("utf8");
		$this->db->query("SET SQL_MODE = ''");
		// $check_open = 1;
	}
	function __destruct(){
		// if($check_open==1){
			// $this->db->close();
		// }
    }
    public function escape($text_escape){
    	return $this->db->real_escape_string($text_escape);
    }
    // public function real_escape_string($string){
    // 	return $this->db->real_escape_string($string);
    // }
    
    public function query($sql) {
    	// echo $sql;
		$query = $this->db->query($sql);
		if (!$this->db->errno) {
			if ($query instanceof \mysqli_result) {
				$data = array();

				while ($row = $query->fetch_assoc()) {
					$data[] = $row;
				}
				$result = new \stdClass();

				$query = $this->db->query("SELECT FOUND_ROWS()");

				$var = $query->fetch_row();
				if($var){
					$result->num_rows = $var[0];
				}else{
					$result->num_rows = 0;
				}
				$result->row = isset($data[0]) ? $data[0] : array();
				$result->rows = $data;

				$query->close();

				return $result;
			} else {
				return true;
			}
		} else {
			// echo $this->db->error;
			trigger_error($sql.'Error: <span style="color:red;">' . $this->db->error  . '</span><br />Error No: <span style="color:orange;">' . $this->db->errno.'</span>');
		}
		return $sql;
	}
	public function getdata($table,$where=NULL,$field=NULL,$order=NULL,$limit=NULL){
    	if($where!=NULL){$where="where ".$where;}
    	if($field==NULL){$field="*";}
    	if($order!=NULL){$order="order by $order";}
		if($limit!=NULL){$limit="limit $limit";}
    	$sql_txt = "select SQL_CALC_FOUND_ROWS ".$field." from ".PREFIX.$table." ".$where." ".$order." ".$limit;

    	$query = $this->db->query($sql_txt) or die("ERROR: ".$sql_txt);
    	if (!$this->db->errno) {
			if ($query instanceof \mysqli_result) {
				$data = array();

				while ($row = $query->fetch_assoc()) {
					$data[] = $row;
				}

				$result = new \stdClass();
				$query = $this->db->query("SELECT FOUND_ROWS()");
				$var = $query->fetch_row();
				if($var){
					$result->num_rows = $var[0];
				}else{
					$result->num_rows = 0;
				}
				//$result->num_rows = $this->db->query("SELECT FOUND_ROWS()")->fetch_row()['0'];
				$result->row = isset($data[0]) ? $data[0] : array();
				$result->rows = $data;

				$query->close();

				return $result;
			} else {
				return true;
			}
		} else {
			trigger_error('Error: ' . $this->db->error  . '<br />Error No: ' . $this->db->errno . '<br />' . $sql);
		}
		// echo "test";
		// var_dump($sql->rows); exit();
    	return $sql;
    }
    public function update($table,$input,$where){
    	$result = false;
		$update = 'update '.PREFIX.$table.' set';	
		$i=1;
		foreach($input as $key => $value){
			//$value = $this->db->real_escape_string($value);
			if($value==""){ $update .= " $key = NULL"; }else{
				$value = iconv(mb_detect_encoding($value, mb_detect_order(), true), "UTF-8", $value);
				$update .= " `$key` = '".$value."'";
			}
			if($i!=count($input)){ $update .= ","; }
			$i++;
		}
		$update .= " where $where";
		// echo $update;exit();
		$query = $this->db->query($update) or die($this->db->error.'<br>'.$update);
		// echo $update;
		$result = ($query?true:false);
	    return $result;
	}
	public function insert($table,$input){
		$insert = 'insert into '.PREFIX.$table.' set';	
		$i=1;

		foreach($input as $key => $value){
			//$value = $this->db->real_escape_string($value);
			$insert .= " `$key` = '".$value."'";
			if($i!=count($input)){ $insert .= ","; }
			$i++;
		}
		$query = $this->db->query($insert) or die($this->db->error);
		if (!$this->db->errno) {
			$result = ($query?$this->getLastId():false);
		} else {
			trigger_error('Error: ' . $this->db->error  . '<br />Error No: ' . $this->db->errno . '<br />' . $insert);
		}
	    return $result;
	}
	public function delete($table,$where){
		$result = false;
		$delete = "delete from ".PREFIX."$table where $where";
		$query = $this->db->query($delete) or die("Error: ".$delete);
		if($query){ 	
            $result = true;
        }
        return $result;
	}
	public function getLastId() {
		return $this->db->insert_id;
	}
}
?>