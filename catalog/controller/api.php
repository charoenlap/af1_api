<?php 
	class ApiController extends Controller {
	    public function index() {
	    	header('Content-type: text/xml');
	    	$xml_string = file_get_contents('php://input');
	    	$time_now = date('H:i:s');
			$date_now = date('Y-m-d').' '.$time_now;
			$xml = '';
	    	if(!empty($xml_string)) {
	    		$xml = @simplexml_load_string($xml_string, "SimpleXMLElement", LIBXML_NOCDATA);
	    		$json = json_encode($xml);
				$array = json_decode($json,TRUE);

				$name_file_booking = time().'_booking';
				$file_name = 'uploads/booking/'.$name_file_booking;
				$fp = fopen($file_name, 'w');
				fwrite($fp, $xml_string);
				fclose($fp);

	    		$insert_log_data = array(
	    			'file_name' 							=> $name_file_booking,
	    			'file_date_create' 						=> $date_now,
	    			'Request_ServiceHeader_MessageTime'		=> $array['Request']['ServiceHeader']['MessageTime'],
	    			'Request_ServiceHeader_MessageReference'=> $array['Request']['ServiceHeader']['MessageReference'],
	    			'Request_ServiceHeader_SiteID'			=> $array['Request']['ServiceHeader']['SiteID'],
	    			'Request_ServiceHeader_Password'		=> $array['Request']['ServiceHeader']['Password'],
	    			'Request_MetaData_SoftwareName'			=> $array['Request']['MetaData']['SoftwareName'],
	    			'Request_MetaData_SoftwareVersion'		=> $array['Request']['MetaData']['SoftwareVersion'],
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
	    		$booking = $this->model('booking');
	    		$result_insert_log_booking = $booking->insert_log_booking($insert_log_data);
	    		if($result_insert_log_booking['result']){
		    		$result_xml_return = array(
		    			'Response' => array(
		    				'ServiceHeader' => array(
		    					'MessageTime' 		=> $date_now,
		    					'MessageReference' 	=> '',
		    					'SiteID'			=> ''
		    				),
		    			),
		    			'RegionCode' => '',
		    				'Note'	=> array(
		    					'ActionNote' => 'Success'
		    				),
		    				'ConfirmationNumber' 	=> $result_insert_log_booking['id'],
		    				'ReadyByTime'			=> $time_now,
		    				'NextPickupDate'		=> '',
		    				'OriginSvcArea'			=> '',
		    				'CountryCode'			=> '',
		    				'RequestorCountryCode'	=> ''
		    		);
				}else{
					$result_xml_return = array(
		    			'Response' => array(
		    				'ServiceHeader' => array(
		    					'MessageTime' => $date_now
		    				)
		    			),
	    				'Status' => array(
	    					'ActionStatus' => 'Error',
	    					'Condition' => array(
	    						'ConditionCode' => 401,
	    						'ConditionData' => 'Unauthorized client error status response code indicates that the request has not been applied because it lacks valid authentication credentials for the target resource'
	    					)
	    				)
		    		);
				}
	    	}else{
	    		$result_xml_return = array(
	    			'Response' => array(
	    				'ServiceHeader' => array(
	    					'MessageTime' => $date_now
	    				)
	    			),
    				'Status' => array(
    					'ActionStatus' => 'Error',
    					'Condition' => array(
    						'ConditionCode' => 107,
    						'ConditionData' => 'Incorrect or Incomplete Input Parameters:Failed to read the request message'
    					)
    				)
	    		);
	    	}
	    	$result_xml = array_to_xml($result_xml_return, $xml);
	    	$xml = new SimpleXMLElement('<?xml version="1.0"?><res:BookPUResponse  xmlns:res="http://www.af1express.com" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation= "http://brightstar.af1express.com/index.php?route=api">'.$result_xml.'</res:BookPUResponse>'); 
			
			$domxml = new DOMDocument('1.0');
			$domxml->preserveWhiteSpace = false;
			$domxml->formatOutput = true;
			$domxml->loadXML($xml->asXML());
			echo $domxml->saveXML();
	    }
	    public function connote() {
	    	header('Content-type: text/xml');
	    	$xml_string = file_get_contents('php://input');
	    	$time_now = date('H:i:s');
			$date_now = date('Y-m-d').' '.$time_now;
	    	if(!empty($xml_string)) {
	    		$xml = @simplexml_load_string($xml_string, "SimpleXMLElement", LIBXML_NOCDATA);
	    		$json = json_encode($xml);
				$array = json_decode($json,TRUE);
				// var_dump($array['Place']);exit();
				$name_file_booking = time().'_connote';
				$file_name = 'uploads/connote/'.$name_file_booking;
				$fp = fopen($file_name, 'w');
				fwrite($fp, $xml_string);
				fclose($fp);
				$site_id = $array['Request']['ServiceHeader']['SiteID'];
				// next process
				$insert_log_data = array(
					'file_name' 							=> $name_file_booking,
					'file_date_create' 						=> $date_now,
					'Request_ServiceHeader_MessageTime'		=> (isset($array['Request']['ServiceHeader']['MessageTime'])?$array['Request']['ServiceHeader']['MessageTime']:''),
	    			'Request_ServiceHeader_MessageReference'=> (isset($array['Request']['ServiceHeader']['MessageReference'])?$array['Request']['ServiceHeader']['MessageReference']:''),
	    			'Request_ServiceHeader_SiteID'			=> (isset($array['Request']['ServiceHeader']['SiteID'])?$array['Request']['ServiceHeader']['SiteID']:''),
	    			'Request_ServiceHeader_Password'		=> (isset($array['Request']['ServiceHeader']['Password'])?$array['Request']['ServiceHeader']['Password']:''),
	    			'Request_MetaData_SoftwareName'			=> (isset($array['Request']['MetaData']['SoftwareName'])?$array['Request']['MetaData']['SoftwareName']:''),
	    			'Request_MetaData_SoftwareVersion'		=> (isset($array['Request']['MetaData']['SoftwareVersion'])?$array['Request']['MetaData']['SoftwareVersion']:''),
					'LanguageCode' 							=> (isset($array['LanguageCode'])?$array['LanguageCode']:''),
					'PiecesEnabled' 						=> (isset($array['PiecesEnabled'])?$array['PiecesEnabled']:''),
					'Billing_ShipperAccountNumber' 			=> (isset($array['Billing']['ShipperAccountNumber'])?$array['Billing']['ShipperAccountNumber']:''),
					'Billing_ShippingPaymentType' 			=> (isset($array['Billing']['ShippingPaymentType'])?$array['Billing']['ShippingPaymentType']:''),
					'Billing_BillingAccountNumber' 			=> (isset($array['Billing']['BillingAccountNumber'])?$array['Billing']['BillingAccountNumber']:''),
					'Consignee_CompanyName' 				=> (isset($array['Consignee']['CompanyName'])?$array['Consignee']['CompanyName']:''),
					'Consignee_AddressLine' 				=> (isset($array['Consignee']['AddressLine'])?$array['Consignee']['AddressLine']:''),
					'Consignee_City' 						=> (isset($array['Consignee']['City'])?$array['Consignee']['City']:''),
					'Consignee_CountryCode' 				=> (isset($array['Consignee']['CountryCode'])?$array['Consignee']['CountryCode']:''),
					'Consignee_CountryName' 				=> (isset($array['Consignee']['CountryName'])?$array['Consignee']['CountryName']:''),
					'Consignee_Contact_PersonName'			=> (isset($array['Consignee']['Contact']['PersonName'])?$array['Consignee']['Contact']['PersonName']:''),
					'Consignee_Contact_PhoneNumber' 		=> (isset($array['Consignee']['Contact']['PhoneNumber'])?$array['Consignee']['Contact']['PhoneNumber']:''),
					'ShipmentDetails_NumberOfPieces' 		=> (isset($array['ShipmentDetails']['NumberOfPieces'])?$array['ShipmentDetails']['NumberOfPieces']:''),
					'ShipmentDetails_Pieces' 				=> (isset($array['ShipmentDetails']['Pieces'])?$array['ShipmentDetails']['Pieces']:''),
					'ShipmentDetails_Weight' 				=> (isset($array['ShipmentDetails']['Weight'])?$array['ShipmentDetails']['Weight']:''),
					'ShipmentDetails_WeightUnit' 			=> (isset($array['ShipmentDetails']['WeightUnit'])?$array['ShipmentDetails']['WeightUnit']:''),
					'ShipmentDetails_GlobalProductCode' 	=> (isset($array['ShipmentDetails']['GlobalProductCode'])?$array['ShipmentDetails']['GlobalProductCode']:''),
					'ShipmentDetails_LocalProductCode' 		=> (isset($array['ShipmentDetails']['LocalProductCode'])?$array['ShipmentDetails']['LocalProductCode']:''),
					'ShipmentDetails_Date' 					=> (isset($array['ShipmentDetails']['Date'])?$array['ShipmentDetails']['Date']:''),
					'ShipmentDetails_Contents' 				=> (isset($array['ShipmentDetails']['Contents'])?$array['ShipmentDetails']['Contents']:''),
					'ShipmentDetails_DoorTo' 				=> (isset($array['ShipmentDetails']['DoorTo'])?$array['ShipmentDetails']['DoorTo']:''),
					'ShipmentDetails_DimensionUnit' 		=> (isset($array['ShipmentDetails']['DimensionUnit'])?$array['ShipmentDetails']['DimensionUnit']:''),
					'ShipmentDetails_PackageType'	 		=> (isset($array['ShipmentDetails']['PackageType'])?$array['ShipmentDetails']['PackageType']:''),
					'ShipmentDetails_CurrencyCode' 			=> (isset($array['ShipmentDetails']['CurrencyCode'])?$array['ShipmentDetails']['CurrencyCode']:''),
					'Shipper_ShipperID' 					=> (isset($array['Shipper']['ShipperID'])?$array['Shipper']['ShipperID']:''),
					'Shipper_CompanyName' 					=> (isset($array['Shipper']['CompanyName'])?$array['Shipper']['CompanyName']:''),
					'Shipper_AddressLine' 					=> (isset($array['Shipper']['Address1'])?$array['Shipper']['Address1']:''),
					'Shipper_AddressLine_2' 				=> (isset($array['Shipper']['Address2'])?$array['Shipper']['Address2']:''),
					'Shipper_CountryCode' 					=> (isset($array['Shipper']['CountryCode'])?$array['Shipper']['CountryCode']:''),
					'Shipper_City' 							=> (isset($array['Shipper']['City'])?$array['Shipper']['City']:''),
					'Shipper_PostalCode'					=> (isset($array['Shipper']['PostalCode'])?$array['Shipper']['PostalCode']:''),
					'Shipper_CountryName' 					=> (isset($array['Shipper']['CountryName'])?$array['Shipper']['CountryName']:''),
					'Shipper_contact_PersonName' 			=> (isset($array['Shipper']['Contact']['PersonName'])?$array['Shipper']['Contact']['PersonName']:''),
					'Shipper_contact_PhoneNumber' 			=> (isset($array['Shipper']['Contact']['PhoneNumber'])?$array['Shipper']['Contact']['PhoneNumber']:''),
					'Place_ResidenceOrBusiness' 			=> (isset($array['Place']['ResidenceOrBusiness'])?$array['Place']['ResidenceOrBusiness']:''),
					'Place_CompanyName' 					=> (isset($array['Place']['CompanyName'])?$array['Place']['CompanyName']:''),
					'Place_AddressLine' 					=> (isset($array['Place']['Address1'])?$array['Place']['Address1']:''),
					'Place_AddressLine_2' 					=> (isset($array['Place']['Address2'])?$array['Place']['Address2']:''),
					'Place_City' 							=> (isset($array['Place']['City'])?$array['Place']['City']:''),
					'Place_CountryCode' 					=> (isset($array['Place']['CountryCode'])?$array['Place']['CountryCode']:''),
					'Place_PostalCode'						=> (isset($array['Place']['PostalCode'])?$array['Place']['PostalCode']:''),
					'LabelImageFormat' 						=> (isset($array['LabelImageFormat'])?$array['LabelImageFormat']:''),
					'RequestArchiveDoc' 					=> (isset($array['RequestArchiveDoc'])?$array['RequestArchiveDoc']:''),
					'Label_LabelTemplate' 					=> (isset($array['Label']['LabelTemplate'])?$array['Label']['LabelTemplate']:''),
					'Label_Logo' 							=> (isset($array['Label']['Logo'])?$array['Label']['Logo']:'')
	    		);

	    		// var_dump($array['Place']);exit();
	    		$connote = $this->model('connote');
	    		$result_insert_log_connote = $connote->insert_log_connote($insert_log_data);
	    		
	    		if($result_insert_log_connote['result']){
					$Consignee_CompanyName 			= $array['Consignee']['CompanyName'];
					$Consignee_AddressLine 			= $array['Consignee']['AddressLine'];
					$Consignee_City 				= $array['Consignee']['City'];
					$Consignee_CountryCode 			= $array['Consignee']['CountryCode'];
					$Consignee_CountryName 			= $array['Consignee']['CountryName'];
					$Consignee_Contact_PersonName 	= $array['Consignee']['Contact']['PersonName'];
					$Consignee_Contact_PhoneNumber 	= $array['Consignee']['Contact']['PhoneNumber'];

					$Shipper_ShipperID 				= $array['Shipper']['ShipperID'];
					$Shipper_CompanyName 			= $array['Shipper']['CompanyName'];
					$Shipper_AddressLine 			= $array['Shipper']['AddressLine'][0];
					$Shipper_AddressLine_2 			= $array['Shipper']['AddressLine'][1];
					$Shipper_City 					= $array['Shipper']['City'];
					$Shipper_CountryName 			= $array['Shipper']['CountryName'];
					$Shipper_CountryCode 			= $array['Shipper']['CountryCode'];
					$Shipper_PostalCode				= $array['Shipper']['PostalCode'];
					$Shipper_contact_PersonName 	= $array['Shipper']['Contact']['PersonName'];
					$Shipper_contact_PhoneNumber 	= $array['Shipper']['Contact']['PhoneNumber'];

					$Billing_ShipperAccountNumber 	= $array['Billing']['ShipperAccountNumber'];
					$Billing_ShippingPaymentType 	= $array['Billing']['ShippingPaymentType'];
					$Billing_BillingAccountNumber 	= $array['Billing']['BillingAccountNumber'];

					$AirwayBillNumber = $result_insert_log_connote['id'];

					// $html .= '<div>'.htmlspecialchars_decode($array['Consignee']['CompanyName']).'</div>';
			  //   	$html .= '<div>'.htmlspecialchars_decode($array['Consignee']['AddressLine']).'</div>';
			  //   	$html .= '<div>'.htmlspecialchars_decode($array['Consignee']['City']).'</div>';
			  //   	$html .= '<div>'.htmlspecialchars_decode($array['Consignee']['CountryName']).'</div>';
					// var_dump($insert_log_data);exit();
					$file_name = 'pdf_label_'.time();
					$path_pdf = DOCUMENT_ROOT.'uploads/pdf_label/'.$file_name.'.pdf';
			    	$html = '<div>';
			    	$html .= '<div><b>From:</b></div>';
					$html .= '<div>'.$Shipper_CompanyName.'</div>';
					$html .= '<div>'.$Shipper_AddressLine.'</div>';
					$html .= '<div>'.$Shipper_AddressLine_2.'</div>';
					$html .= '<div>'.$Shipper_City.'</div>';
					$html .= '<div>'.$Shipper_CountryCode.'</div>';
					$html .= '<div>'.$Shipper_CountryName.'</div>';
					$html .= '<div>'.$Shipper_PostalCode.'</div>';

			  //   	$html .= '<div>'.$insert_log_data['Place_CompanyName'].'</div>';
					// $html .= '<div>'.$insert_log_data['Place_AddressLine'].'</div>';
					// $html .= '<div>'.$insert_log_data['Place_AddressLine_2'].'</div>';
					// $html .= '<div>'.$insert_log_data['Place_City'].'</div>';
					// $html .= '<div>'.$insert_log_data['Place_PostalCode'].'</div>';
					$html .= '</div>';

			    	$html .= '<p></p>';

			    	$html .= '<div>';
			    	$html .= '<div><b>To:</b></div>';
			    	$html .= '<div>AIR FORCE ONE EXPRESS CO.,LTD</div>';
			    	$html .= '<div>519 Soi Soonvijai4,</div>';
			    	$html .= '<div>Rama9 road, Kwaeng Bangkapi</div>';
			    	$html .= '<div>Khet Huaykwang Bangkok 10310</div>';
			    	$html .= '<div>Thailand</div>';
			    	$html .= '<div></div>';
			    	$html .= '<div>'.date('Y-m-d H:i:s').'</div>';
			    	$html .= '<div>Airwaybill no: '.$AirwayBillNumber.'</div>';
			    	$html .= '</div>';
			    	$data_pdf = array(
			    		'file_name' => $file_name,
			    		'path' 		=> $path_pdf
			    	);
			    	$result_pdf = $this->downloadPdf($html,$data_pdf);
			    	// $handle = fopen($path_pdf, "r");
			    	$handle = fopen($path_pdf, "r") or die("Unable to open file!");
			    	$result_file_pdf = '';
					while(!feof($handle)) {
					  $result_file_pdf .= fgetc($handle);
					}
					fclose($handle);
			    	$b64Doc = base64_encode($result_file_pdf);

					$result_xml_return = array(
		    			'Response' => array(
		    				'ServiceHeader' => array(
		    					'MessageTime' 		=> $date_now,
		    					'MessageReference' 	=> '',
		    					'SiteID'			=> $site_id
		    				)
		    			),
	    				'RegionCode'			=> '',
	    				'Note'			=> array(
	    					'ActionNote'		=> 'Success'
	    				),
	    				'AirwayBillNumber'	=> $AirwayBillNumber,
	    				'BillingCode'		=> '',
						'CurrencyCode'		=> '',
						'CourierMessage'	=> '',
						'DestinationServiceArea' => array(
							'ServiceAreaCode'	=> '',
							'FacilityCode'		=> '',
							'InboundSortCode'	=> ''
						),
						'PackageCharge' 	=> '',
						'Rated' 			=> '',
						'ShippingCharge' 	=> '',
						'WeightUnit' 		=> '',
						'ChargeableWeight' 	=> '',
						'DimensionalWeight' => '',
						'CountryCode' 		=> '',
						'Barcodes'			=> array(
							'AWBBarCode'		=> '',
							'OriginDestnBarcode'=> '',
							'DHLRoutingBarCode'	=> ''
						),
						'Piece'		=> '',
						'Contents' 	=> '',
						'Consignee' => array(
							'CompanyName'			=> htmlspecialchars($Consignee_CompanyName),
							'AddressLine'			=> htmlspecialchars($Consignee_AddressLine),
							'City'					=> htmlspecialchars($Consignee_City),
							'CountryCode'			=> htmlspecialchars($Consignee_CountryCode),
							'CountryName'			=> htmlspecialchars($Consignee_CountryName),
							'ContactPersonName'		=> htmlspecialchars($Consignee_Contact_PersonName),
							'ContactPhoneNumber'		=> htmlspecialchars($Consignee_Contact_PhoneNumber),
						),
						'Shipper' => array(
							'ShipperID'				=> $Shipper_ShipperID,
							'CompanyName'			=> $Shipper_CompanyName,
							'AddressLine'			=> $Shipper_AddressLine,
							'AddressLine_2'			=> $Shipper_AddressLine_2,
							'City'					=> $Shipper_City,
							'CountryCode'			=> $Shipper_CountryCode,
							'CountryName'			=> $Shipper_CountryName,
							'Contact' => array(
								'PersonName'		=> $Shipper_contact_PersonName,
								'PhoneNumber'		=> $Shipper_contact_PhoneNumber,
							)
						),
						'CustomerID'		=> '',
						'ShipmentDate'		=> '',
						'GlobalProductCode'	=> '',
						'Billing' => array(
							'ShipperAccountNumber'	=> htmlspecialchars($Billing_ShipperAccountNumber),
							'ShippingPaymentType'	=> htmlspecialchars($Billing_ShippingPaymentType),
							'BillingAccountNumber'	=> htmlspecialchars($Billing_BillingAccountNumber),
							'DutyPaymentType'		=> ''
						),
						'DHLRoutingCode' 		=> '',
						'DHLRoutingDataId' 		=> '',
						'ProductContentCode'	=> '',
						'ProductShortName' 		=> '',
						'InternalServiceCode' 	=> '',
						'DeliveryDateCode' 		=> '',
						'DeliveryTimeCode' 		=> '',
						'Pieces'	=> array(
							'Piece' => array(
								'PieceNumber' 			=> '',
								'Depth' 				=> '',
								'Width' 				=> '',
								'Height' 				=> '',
								'Weight' 				=> '',
								'PackageType' 			=> '',
								'DimWeight' 			=> '',
								'DataIdentifier'		=> '',
								'LicensePlate' 			=> '',
								'LicensePlateBarCode' 	=> ''
							)
						),
						'QtdSInAdCur' => array(
							'CurrencyCode' => '',
							'CurrencyRoleTypeCode' => '',
							'PackageCharge' => '',
							'ShippingCharge' => ''
						),
						'LabelImage' => array(
							'OutputFormat' 		=> 'PDF',
							'OutputImage'		=> $b64Doc,
							'OutputPathPDF' 	=> $file_name,
							'OutputFullPathPDF' => 'http://brightstar.af1express.com/uploads/pdf_label/'.$file_name.'.pdf',
						),
						'Label'	=> array(
							'LabelTemplate'=>''
						)
		    		);
		    		
				}else{
					$result_xml_return = array(
		    			'Response' => array(
		    				'ServiceHeader' => array(
		    					'MessageTime' => $date_now
		    				)
		    			),
	    				'Status' => array( 
	    					'ActionStatus' => 'Error',
	    					'Condition' => array(
	    						'ConditionCode' => 401,
	    						'ConditionData' => 'Unauthorized client error status response code indicates that the request has not been applied because it lacks valid authentication credentials for the target resource'
	    					)
	    				)
		    		);
				}
	    	}else{
	    		$result_xml_return = array(
	    			'Response' => array(
	    				'ServiceHeader' => array(
	    					'MessageTime' => $date_now
	    				)
	    			),
    				'Status' => array(
    					'ActionStatus' => 'Error',
    					'Condition' => array(
    						'ConditionCode' => 107,
    						'ConditionData' => 'Incorrect or Incomplete Input Parameters:Failed to read the request message'
    					)
    				)
	    		);
	    	}
			$result_xml = array_to_xml($result_xml_return, $xml);
			
	    	$xml = new SimpleXMLElement('<?xml version="1.0"?><res:ShipmentResponse  xmlns:res="http://www.af1express.com" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation= "http://brightstar.af1express.com/index.php?route=api/connote">'.$result_xml.'</res:ShipmentResponse>'); 

	    	$domxml = new DOMDocument('1.0');
			$domxml->preserveWhiteSpace = false;
			$domxml->formatOutput = true;
			$domxml->loadXML($xml->asXML());
			echo $domxml->saveXML();
	    }
	    public function status() {
	    	header('Content-type: text/xml');
	    	$xml_string = file_get_contents('php://input');
	    	$time_now = date('H:i:s');
			$date_now = date('Y-m-d').' '.$time_now;
	    	if(!empty($xml_string)) {
	    		$xml = @simplexml_load_string($xml_string, "SimpleXMLElement", LIBXML_NOCDATA);
	    		$json = json_encode($xml);
				$array = json_decode($json,TRUE);
				// var_dump($array);exit();

				$name_file_status = time().'_status';
				$file_name = 'uploads/status/'.$name_file_status;
				$fp = fopen($file_name, 'w');
				fwrite($fp, $xml_string);
				fclose($fp);

				// next process
				$insert_log_data = array(
					'file_name' 							=> $name_file_status,
					'file_date_create' 						=> $date_now,
					'Request_ServiceHeader_MessageTime' 	=> $array['Request']['ServiceHeader']['MessageTime'],
					'Request_ServiceHeader_MessageReference'=> $array['Request']['ServiceHeader']['MessageReference'],
					'Request_ServiceHeader_SiteID' 			=> $array['Request']['ServiceHeader']['SiteID'],
					'Request_ServiceHeader_Password' 		=> $array['Request']['ServiceHeader']['Password'],
					'LanguageCode' 							=> $array['LanguageCode'],
					'AWBNumber' 							=> $array['AWBNumber'],
					'LevelOfDetails' 						=> $array['LevelOfDetails']
	    		);
	    		$status = $this->model('status');
	    		$result_insert_log_status = $status->insert_log_status($insert_log_data);
	    		if($result_insert_log_status){
	    			// $AWBNumber = $result_insert_log_status['AWB'];
	    			

					$result_xml_return = array(
		    			'Response' => array(
		    				'ServiceHeader' => array(
		    					'MessageTime' 		=> $date_now,
		    					'MessageReference' 	=> '',
		    					'SiteID'			=> ''
		    				)
		    			)
		    		);
		    		$i=0;
		    		foreach($result_insert_log_status as $val) {
		    			$status = $val['Status']['ActionStatus'];
		    			if($status=='No Shipments Found'){
			    			$result_xml_return['AWBInfo_remove_'.$i] = array(
			    				'AWBNumber' => $val['AWBNumber'],
			    				'Status'	=> array(
									'ActionStatus'	=> 'No Shipments Found',
									'Condition'		=> array(
										'ConditionCode' => 209,
										'ConditionData'	=> 'No Shipments Found for AWBNumber '.$val['AWBNumber']
									),
								),
							);
			    		}else{
			    			$result_xml_return['AWBInfo_remove_'.$i] = array(
			    				'AWBNumber' => $val['AWBNumber'],
			    				'Status'	=> array(
									'ActionStatus'	=> $val['Status']['ActionStatus']
								),
								'ShipmentInfo' => array(
									'OriginServiceArea' => array(
										'ServiceAreaCode' 	=> $val['ShipmentInfo']['OriginServiceArea']['ServiceAreaCode'],
										'Description'		=> $val['ShipmentInfo']['OriginServiceArea']['Description']
									),
									'DestinationServiceArea'	=> array(
										'ServiceAreaCode'	=> $val['ShipmentInfo']['DestinationServiceArea']['ServiceAreaCode'],
										'Description'		=> $val['ShipmentInfo']['DestinationServiceArea']['Description']
									),
									'ShipperName'			=> $val['ShipmentInfo']['ShipperName'],
									'ShipperAccountNumber'	=> $val['ShipmentInfo']['ShipperAccountNumber'],
									'ConsigneeName'			=> $val['ShipmentInfo']['ConsigneeName'],
									'ShipmentDate'			=> $val['ShipmentInfo']['ShipmentDate'],
									'Pieces'				=> $val['ShipmentInfo']['Pieces'],
									'Weight'				=> $val['ShipmentInfo']['Weight'],
									'WeightUnit'			=> $val['ShipmentInfo']['WeightUnit'],
									'GlobalProductCode'		=> $val['ShipmentInfo']['GlobalProductCode'],
									'ShipmentDesc'			=> $val['ShipmentInfo']['ShipmentDesc'],
									'DlvyNotificationFlag'	=> $val['ShipmentInfo']['DlvyNotificationFlag'],
									'Shipper' => array(
										// 'CompanyName'
										// 'City'			=> $val['ShipmentInfo']['Shipper']['City'],
										// 'CountryCode'	=> $val['ShipmentInfo']['Shipper']['CountryCode'],
										'ShipperID'				=> htmlspecialchars($val['ShipmentInfo']['Shipper']['ShipperID']),
										'CompanyName'			=> htmlspecialchars($val['ShipmentInfo']['Shipper']['CompanyName']),
										'AddressLine'			=> htmlspecialchars($val['ShipmentInfo']['Shipper']['AddressLine']),
										'AddressLine_remove'	=> htmlspecialchars($val['ShipmentInfo']['Shipper']['AddressLine_2']),
										'City'					=> htmlspecialchars($val['ShipmentInfo']['Shipper']['City']),
										'CountryCode'			=> '',
										'CountryName'			=> htmlspecialchars($val['ShipmentInfo']['Shipper']['CountryName']),
										'Contact' => array(
											'ContactPersonName'		=> htmlspecialchars($val['ShipmentInfo']['Shipper']['Contact']['PersonName']),
											'ContactPhoneNumber'	=> htmlspecialchars($val['ShipmentInfo']['Shipper']['Contact']['PhoneNumber']),
										)
									),
									'Consignee'	=> array(
										'City'			=> $val['ShipmentInfo']['Consignee']['City'],
										'CountryCode'	=> $val['ShipmentInfo']['Consignee']['CountryCode'],
									),
									'ShipperReference'	=> array(
										'ReferenceID'	=> $val['ShipmentInfo']['ShipperReference']['ReferenceID'],
									),
									'ShipmentEvent'	=> array(
										'Date'	=> $val['ShipmentInfo']['ShipmentEvent']['Date'],
										'Time'	=> $val['ShipmentInfo']['ShipmentEvent']['Time'],
										'ServiceEvent'	=> array(
											'EventCode'=>$val['ShipmentInfo']['ShipmentEvent']['ServiceEvent']['EventCode'],
											'Description'=>$val['ShipmentInfo']['ShipmentEvent']['ServiceEvent']['Description'],
										),
										'Signatory'	=> $val['ShipmentInfo']['ShipmentEvent']['Signatory'],
										'ServiceArea' => array(
											'ServiceAreaCode'=>$val['ShipmentInfo']['ShipmentEvent']['ServiceArea']['ServiceAreaCode'],
											'Description'=>$val['ShipmentInfo']['ShipmentEvent']['ServiceArea']['Description']
										),
									),
								)
			    			);
			    		}
		    			$i++;
		    		}
		    		
		    		$result_xml_return['LanguageCode'] = 'en';
				} else{
					$result_xml_return = array(
		    			'Response' => array(
		    				'ServiceHeader' => array(
		    					'MessageTime' => $date_now
		    				)
		    			),
	    				'Status' => array(
	    					'ActionStatus' => 'Error',
	    					'Condition' => array(
	    						'ConditionCode' => 401,
	    						'ConditionData' => 'Unauthorized client error status response code indicates that the request has not been applied because it lacks valid authentication credentials for the target resource'
	    					)
	    				)
		    		);
				}
	    	}else{
	    		$result_xml_return = array(
	    			'Response' => array(
	    				'ServiceHeader' => array(
	    					'MessageTime' 	=> $date_now,
	    					'SiteID'		=> ''
	    				)
	    			),
    				'Status' => array(
    					'ActionStatus' => 'Error',
    					'Condition' => array(
    						'ConditionCode' => 107,
    						'ConditionData' => 'Incorrect or Incomplete Input Parameters:Failed to read the request message',
    						'LanguageCode'	=> ''
    					)
    				)
	    		);
	    	}
	    	// var_dump($result_xml_return);
	    	$result_xml = array_to_xml($result_xml_return, $xml);
	    	$xml = new SimpleXMLElement('<?xml version="1.0"?><req:TrackingResponse  xmlns:req="http://www.af1express.com" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation= "http://brightstar.af1express.com/index.php?route=api/status">'.$result_xml.'</req:TrackingResponse>'); 
			
			// var_dump($xml);
			$domxml = new DOMDocument('1.0');
			$domxml->preserveWhiteSpace = false;
			$domxml->formatOutput = true;
			$domxml->loadXML($xml->asXML());
			echo $domxml->saveXML();
	    }
	}
?>