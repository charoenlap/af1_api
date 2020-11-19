<?php 
	class ApiController extends Controller {
	    public function index() {
	    	$xml_string = file_get_contents('php://input');
	    	$time_now = date('H:i:s');
			$date_now = date('Y-m-d').' '.$time_now;
	    	if(!empty($xml_string)){
	    		$xml = @simplexml_load_string($xml_string, "SimpleXMLElement", LIBXML_NOCDATA);
	    		$json = json_encode($xml);
				$array = json_decode($json,TRUE);

				$name_file_booking = time().'_booking';
				$file_name = 'uploads/booking/'.$name_file_booking;
				$fp = fopen($file_name, 'w');
				fwrite($fp, $xml_string);
				fclose($fp);

	    		$booking = $this->model('booking');
	    		$insert_log_data = array(
	    			'file_name' 							=> $name_file_booking,
	    			'file_date_create' 						=> $date_now,
	    			'Requestor_AccountType' 				=> $array['Requestor']['AccountType'],
	    			'Requestor_AccountNumber' 				=> $array['Requestor']['AccountNumber'],
	    			'Requestor_PersonName' 					=> $array['Requestor']['RequestorContact']['PersonName'],
	    			'Requestor_Phone' 						=> $array['Requestor']['RequestorContact']['Phone'],
	    			'Requestor_CompanyName' 				=> $array['Requestor']['CompanyName'],
	    			'Requestor_Address1' 					=> $array['Requestor']['Address1'],
	    			'Requestor_City' 						=> $array['Requestor']['City'],
	    			'Requestor_CountryCode' 				=> $array['Requestor']['CountryCode'],
	    			'Place_LocationType' 					=> $array['Place']['LocationType'],
	    			'Place_CompanyName' 					=> $array['Place']['CompanyName'],
	    			'Place_Address1' 						=> $array['Place']['Address1'],
	    			'Place_PackageLocation' 				=> $array['Place']['PackageLocation'],
	    			'Place_City' 							=> $array['Place']['City'],
	    			'Place_CountryCode' 					=> $array['Place']['CountryCode'],
	    			'Pickup_PickupDate' 					=> $array['Pickup']['PickupDate'],
	    			'Pickup_PickupTypeCode' 				=> $array['Pickup']['PickupTypeCode'],
	    			'Pickup_ReadyByTime' 					=> $array['Pickup']['ReadyByTime'],
	    			'Pickup_CloseTime' 						=> $array['Pickup']['CloseTime'],
	    			'Pickup_Pieces' 						=> $array['Pickup']['Pieces'],
	    			'PickupContact_PersonName' 				=> $array['PickupContact']['PersonName'],
	    			'PickupContact_Phone' 					=> $array['PickupContact']['Phone'],
	    			'ShipmentDetails_AccountType' 			=> $array['ShipmentDetails']['AccountType'],
	    			'ShipmentDetails_AccountNumber' 		=> $array['ShipmentDetails']['AccountNumber'],
	    			'ShipmentDetails_BillToAccountNumber' 	=> $array['ShipmentDetails']['BillToAccountNumber'],
	    			'ShipmentDetails_NumberOfPieces' 		=> $array['ShipmentDetails']['NumberOfPieces'],
	    			'ShipmentDetails_Weight' 				=> $array['ShipmentDetails']['Weight'],
	    			'ShipmentDetails_WeightUnit' 			=> $array['ShipmentDetails']['WeightUnit'],
	    			'ShipmentDetails_GlobalProductCode' 	=> $array['ShipmentDetails']['GlobalProductCode'],
	    			'ShipmentDetails_LocalProductCode' 		=> $array['ShipmentDetails']['LocalProductCode'],
	    			'ShipmentDetails_DoorTo' 				=> $array['ShipmentDetails']['DoorTo'],
	    			'ShipmentDetails_DimensionUnit' 		=> $array['ShipmentDetails']['DimensionUnit'],
	    			'ConsigneeDetails_CompanyName' 			=> $array['ConsigneeDetails']['CompanyName'],
	    			'ConsigneeDetails_AddressLine' 			=> $array['ConsigneeDetails']['AddressLine'],
	    			'ConsigneeDetails_City' 				=> $array['ConsigneeDetails']['City'],
	    			'ConsigneeDetails_CountryCode' 			=> $array['ConsigneeDetails']['CountryCode'],
	    			'ConsigneeDetails_PersonName' 			=> $array['ConsigneeDetails']['Contact']['PersonName'],
	    			'ConsigneeDetails_Phone' 				=> $array['ConsigneeDetails']['Contact']['Phone'],
	    		);
	    		$result_insert_log_booking = $booking->insert_log_booking($insert_log_data);

	    		$result_xml_return = array(
	    			'Response' => array(
	    				'ServiceHeader' => array(
	    					'MessageTime' 		=> $date_now,
	    					'MessageReference' 	=> '',
	    					'SiteID'			=> ''
	    				),
	    				'RegionCode' => '',
	    				'Note'	=> array(
	    					'ActionNote' => 'Success'
	    				),
	    				'ConfirmationNumber' 	=> $result_insert_log_booking,
	    				'ReadyByTime'			=> $time_now,
	    				'NextPickupDate'		=> '',
	    				'OriginSvcArea'			=> '',
	    				'CountryCode'			=> '',
	    				'RequestorCountryCode'	=> ''
	    			)
	    		);
	    		$xml = new SimpleXMLElement('<Projects/>'); 
				array_to_xml($result_xml_return, $xml);
				$domxml = new DOMDocument('1.0');
				$domxml->preserveWhiteSpace = false;
				$domxml->formatOutput = true;
				$domxml->loadXML($xml->asXML());
				echo $domxml->saveXML();
	    	}else{
	    		$result_xml_return = array(
	    			'Response' => array(
	    				'ServiceHeader' => array(
	    					'MessageTime' => $date_now
	    				),
	    				'Status' => array(
	    					'ActionStatus' => 'Error',
	    					'Condition' => array(
	    						'ConditionCode' => 107,
	    						'ConditionData' => 'Incorrect or Incomplete Input Parameters:Failed to read the request message'
	    					)
	    				)
	    			)
	    		);
	    		$xml = new SimpleXMLElement('<Projects/>'); 
				array_to_xml($result_xml_return, $xml);
				$domxml = new DOMDocument('1.0');
				$domxml->preserveWhiteSpace = false;
				$domxml->formatOutput = true;
				$domxml->loadXML($xml->asXML());
				echo $domxml->saveXML();
	    	}
	    }
	}
?>