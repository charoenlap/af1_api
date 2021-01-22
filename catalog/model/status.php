<?php 
	class StatusModel extends db {
		public function insert_log_status($data = array()){
			$result = array();
			$id = $data['Request_ServiceHeader_SiteID'];
			$pass = md5($data['Request_ServiceHeader_Password']);
			$sql = "SELECT * FROM api_auth WHERE `username`='".$id."' AND `password`='".$pass."' LIMIT 0,1";
			$result_login = $this->query($sql);
			if($result_login->num_rows){
				$AWBNumber = $data['AWBNumber'];
				$status_text = '';
				$event_code = '';
				$status_desc = '';
				foreach($AWBNumber as $val){
					$sql = 'SELECT * FROM api_log_connote 
					LEFT JOIN api_connote_status ON api_connote_status.status_id = api_log_connote.connote_status
					WHERE id_log_connote = '.(int)$val;
					$result_AWB = $this->query($sql);
					if($result_AWB->num_rows > 0){
						$status_text = 'success';
						$event_code = $result_AWB->row['event_code'];
						$status_desc = $result_AWB->row['title'];
					}else{
						$status_text = 'No Shipments Found';
					}
					// $result_AWB->row['connote_status']=='0'
					$ShipperName = (isset($result_AWB->row['Shipper_CompanyName'])?$result_AWB->row['Shipper_CompanyName']:'');
					$ShipperAccountNumber = (isset($result_AWB->row['Shipper_ShipperID'])?$result_AWB->row['Shipper_ShipperID']:'');
					$ConsigneeName = (isset($result_AWB->row['Consignee_CompanyName'])?$result_AWB->row['Consignee_CompanyName']:'');
					$ShipmentDate = (isset($result_AWB->row['ShipmentDetails_Date'])?$result_AWB->row['ShipmentDetails_Date']:'');
					$Pieces = (isset($result_AWB->row['ShipmentDetails_PieceID'])?$result_AWB->row['ShipmentDetails_PieceID']:'');
					$Weight = (isset($result_AWB->row['ShipmentDetails_Weight'])?$result_AWB->row['ShipmentDetails_Weight']:'');
					$WeightUnit = (isset($result_AWB->row['ShipmentDetails_WeightUnit'])?$result_AWB->row['ShipmentDetails_WeightUnit']:'');
					$GlobalProductCode = (isset($result_AWB->row['ShipmentDetails_GlobalProductCode'])?$result_AWB->row['ShipmentDetails_GlobalProductCode']:'');
					$ShipmentDesc = (isset($result_AWB->row['ShipmentDetails_Contents'])?$result_AWB->row['ShipmentDetails_Contents']:'');
					$result[] = array(
						'AWBNumber' => $val,
						'Status'	=> array(
							'ActionStatus'	=> 'Success'
						),
						'ShipmentInfo' => array(
							'OriginServiceArea' => array(
								'ServiceAreaCode' 	=> '',
								'Description'		=> ''
							),
							'DestinationServiceArea'	=> array(
								'ServiceAreaCode'	=> '',
								'Description'		=> ''
							),
							'ShipperName'			=> $ShipperName,
							'ShipperAccountNumber'	=> $ShipperAccountNumber,
							'ConsigneeName'			=> $ConsigneeName,
							'ShipmentDate'			=> $ShipmentDate,
							'Pieces'				=> $Pieces,
							'Weight'				=> $Weight,
							'WeightUnit'			=> $WeightUnit,
							'GlobalProductCode'		=> $GlobalProductCode,
							'ShipmentDesc'			=> $ShipmentDesc,
							'DlvyNotificationFlag'	=> '',
							// 'City'			=> $result_AWB->row['Shipper_City'],
							// 'CountryCode'	=> $result_AWB->row['Shipper_CountryCode'],
							'Shipper' => array(
								
								'ShipperID'				=> '',
								'CompanyName'			=> 'Apple Iconsiam',
								'AddressLine'			=> '299 Charoennakorn Road',
								'AddressLine_2'	=> 'Khlong Ton Sai, Khlong San',
								'City'					=> 'Bangkok',
								'CountryCode'			=> '10600',
								'CountryName'			=> 'TH',
								'Contact' => array(
									'PersonName'		=> 'R733 TH',
									'PhoneNumber'		=> '00 0000 0000',
								)
							),
							'Consignee'	=> array(
								'City'			=> (isset($result_AWB->row['Consignee_City'])?$result_AWB->row['Consignee_City']:''),
								'CountryCode'	=> (isset($result_AWB->row['Consignee_CountryCode'])?$result_AWB->row['Consignee_CountryCode']:''),
							),
							'ShipperReference'	=> array(
								'ReferenceID'	=> '',
							),
							'ShipmentEvent'	=> array(
								'Date'	=> date('Y-m-d'),
								'Time'	=> date('H:i:s'),
								'ServiceEvent'	=> array(
									'EventCode'=>$event_code,
									'Description'=>$status_desc
								),
								'Signatory'	=> '',
								'ServiceArea' => array(
									'ServiceAreaCode'=>'',
									'Description'=>''
								),
							),
						)
					);
				}
			}
			// $id = $data['Request_ServiceHeader_SiteID'];
			// $pass = md5($data['Request_ServiceHeader_Password']);
			// $result_login = $this->query("SELECT * FROM api_auth WHERE `username`='".$id."' AND `password`='".$pass."' LIMIT 0,1");
			// if($result_login->num_rows){
			// 	$data_insert = $data;
			// 	$result_detail = $this->insert('api_log_status',$data_insert);
			// }else{
			// 	$result = array(
			// 		'result' => false
			// 	);
			// }
			return $result;
		}
	}
?>