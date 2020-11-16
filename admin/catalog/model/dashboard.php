<?php 
	class DashboardModel extends db {
		public function getTotalGirls($data = array()){
			$result = array();
			$sql = "SELECT COUNT(girls_id) AS total_girls FROM dh_girls WHERE girls_type='1' OR girls_type='3' OR girls_type='4'";
			$result['total_girls'] = $this->query($sql)->row['total_girls'];
			$sql = "SELECT COUNT(girls_id) AS total_girls_host FROM dh_girls WHERE girls_type='6' OR girls_type='7'";
			$result['total_girls_host'] = $this->query($sql)->row['total_girls_host'];

			return $result;
		}
	}
?>