<?php 
	class ConnoteModel extends db {
		public function insert_log_connote($data = array()){
			$id = $data['Request_ServiceHeader_SiteID'];
			$pass = md5($data['Request_ServiceHeader_Password']);
			$result_login = $this->query("SELECT * FROM api_auth WHERE `username`='".$id."' AND `password`='".$pass."' LIMIT 0,1");
			if($result_login->num_rows){
				$data_insert = $data;
				$result_detail = $this->insert('api_log_status',$data_insert);
			}else{
				$result = array(
					'result' => false
				);
			}
			return $result;
		}
	}
?>