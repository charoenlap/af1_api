<?php 
	class ApiController extends Controller {
	    public function index() {
	    	header('Content-type: text/xml');
	    	$xml_string = file_get_contents('php://input');
	    	$time_now = date('H:i:s');
			$date_now = date('Y-m-d').' '.$time_now;
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
		    			)
		    		);
				}else{
					$result_xml_return = array(
		    			'Response' => array(
		    				'ServiceHeader' => array(
		    					'MessageTime' => $date_now
		    				),
		    				'Status' => array(
		    					'ActionStatus' => 'Error',
		    					'Condition' => array(
		    						'ConditionCode' => 401,
		    						'ConditionData' => 'Unauthorized client error status response code indicates that the request has not been applied because it lacks valid authentication credentials for the target resource'
		    					)
		    				)
		    			)
		    		);
				}
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
	    	}
	    	$xml = new SimpleXMLElement("<res:BookPUResponse  xmlns:res='http://www.dhl.com' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation= 'http://www.dhl.com pickup-res.xsd'/>"); 
			array_to_xml($result_xml_return, $xml);
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
					'Request_ServiceHeader_MessageTime'		=> $array['Request']['ServiceHeader']['MessageTime'],
	    			'Request_ServiceHeader_MessageReference'=> $array['Request']['ServiceHeader']['MessageReference'],
	    			'Request_ServiceHeader_SiteID'			=> $array['Request']['ServiceHeader']['SiteID'],
	    			'Request_ServiceHeader_Password'		=> $array['Request']['ServiceHeader']['Password'],
	    			'Request_MetaData_SoftwareName'			=> $array['Request']['MetaData']['SoftwareName'],
	    			'Request_MetaData_SoftwareVersion'		=> $array['Request']['MetaData']['SoftwareVersion'],
					'LanguageCode' 							=> $array['LanguageCode'],
					'PiecesEnabled' 						=> $array['PiecesEnabled'],
					'Billing_ShipperAccountNumber' 			=> $array['Billing']['ShipperAccountNumber'],
					'Billing_ShippingPaymentType' 			=> $array['Billing']['ShippingPaymentType'],
					'Billing_BillingAccountNumber' 			=> $array['Billing']['BillingAccountNumber'],
					'Consignee_CompanyName' 				=> $array['Consignee']['CompanyName'],
					'Consignee_AddressLine' 				=> $array['Consignee']['AddressLine'],
					'Consignee_City' 						=> $array['Consignee']['City'],
					'Consignee_CountryCode' 				=> $array['Consignee']['CountryCode'],
					'Consignee_CountryName' 				=> $array['Consignee']['CountryName'],
					'Consignee_Contact_PersonName'			=> $array['Consignee']['Contact']['PersonName'],
					'Consignee_Contact_PhoneNumber' 		=> $array['Consignee']['Contact']['PhoneNumber'],
					'ShipmentDetails_NumberOfPieces' 		=> $array['ShipmentDetails']['NumberOfPieces'],
					'ShipmentDetails_Pieces' 				=> $array['ShipmentDetails']['Pieces'], // 
					'ShipmentDetails_Weight' 				=> $array['ShipmentDetails']['Weight'],
					'ShipmentDetails_WeightUnit' 			=> $array['ShipmentDetails']['WeightUnit'],
					'ShipmentDetails_GlobalProductCode' 	=> $array['ShipmentDetails']['GlobalProductCode'],
					'ShipmentDetails_LocalProductCode' 		=> $array['ShipmentDetails']['LocalProductCode'],
					'ShipmentDetails_Date' 					=> $array['ShipmentDetails']['Date'],
					'ShipmentDetails_Contents' 				=> $array['ShipmentDetails']['Contents'],
					'ShipmentDetails_DoorTo' 				=> $array['ShipmentDetails']['DoorTo'],
					'ShipmentDetails_DimensionUnit' 		=> $array['ShipmentDetails']['DimensionUnit'],
					'ShipmentDetails_PackageType'	 		=> $array['ShipmentDetails']['PackageType'],
					'ShipmentDetails_CurrencyCode' 			=> $array['ShipmentDetails']['CurrencyCode'],
					'Shipper_ShipperID' 					=> $array['Shipper']['ShipperID'],
					'Shipper_CompanyName' 					=> $array['Shipper']['CompanyName'],
					'Shipper_AddressLine' 					=> $array['Shipper']['AddressLine'],
					// 'Shipper_AddressLine' 					=> $array['Shipper']['AddressLine'],
					// 'Shipper_PostalCode' 					=> $array['Shipper']['PostalCode'],
					'Shipper_City' 							=> $array['Shipper']['City'],
					'Shipper_CountryName' 					=> $array['Shipper']['CountryName'],
					'Shipper_contact_PersonName' 			=> $array['Shipper']['Contact']['PersonName'],
					'Shipper_contact_PhoneNumber' 			=> $array['Shipper']['Contact']['PhoneNumber'],
					'Place_ResidenceOrBusiness' 			=> $array['Place']['ResidenceOrBusiness'],
					'Place_CompanyName' 					=> $array['Place']['CompanyName'],
					'Place_AddressLine' 					=> $array['Place']['AddressLine'],
					'Place_City' 							=> $array['Place']['City'],
					'Place_CountryCode' 					=> $array['Place']['CountryCode'],
					'LabelImageFormat' 						=> $array['LabelImageFormat'],
					'RequestArchiveDoc' 					=> $array['RequestArchiveDoc'],
					'Label_LabelTemplate' 					=> $array['Label']['LabelTemplate'],
					'Label_Logo' 							=> $array['Label']['Logo']
	    		);
	    		// var_dump($insert_log_data);exit();
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
					$Shipper_AddressLine 			= $array['Shipper']['AddressLine'];

					$Shipper_City 					= $array['Shipper']['City'];
					$Shipper_CountryName 			= $array['Shipper']['CountryName'];
					$Shipper_contact_PersonName 	= $array['Shipper']['Contact']['PersonName'];
					$Shipper_contact_PhoneNumber 	= $array['Shipper']['Contact']['PhoneNumber'];

					$Billing_ShipperAccountNumber 	= $array['Billing']['ShipperAccountNumber'];
					$Billing_ShippingPaymentType 	= $array['Billing']['ShippingPaymentType'];
					$Billing_BillingAccountNumber 	= $array['Billing']['BillingAccountNumber'];

					$AirwayBillNumber = 0;

					$file_name = 'pdf_label_'.time();
					$path_pdf = DOCUMENT_ROOT.'uploads/pdf_label/'.$file_name.'.pdf';
			    	$html = '<div>';
			    	$html .= '<div><b>From:</b></div>';
			    	$html .= '<div>'.htmlspecialchars_decode($array['Shipper']['CompanyName']).'</div>';
			    	$html .= '<div>'.htmlspecialchars_decode($array['Shipper']['AddressLine']).'</div>';
			    	$html .= '<div>'.htmlspecialchars_decode($array['Shipper']['City']).'</div>';
			    	$html .= '<div>'.htmlspecialchars_decode($array['Shipper']['CountryName']).'</div>';
			    	$html .= '</div>';
			    	$html .= '<p></p>';
			    	$html .= '<div>';
			    	$html .= '<div><b>To:</b></div>';
			    	$html .= '<div>'.htmlspecialchars_decode($array['Consignee']['CompanyName']).'</div>';
			    	$html .= '<div>'.htmlspecialchars_decode($array['Consignee']['AddressLine']).'</div>';
			    	$html .= '<div>'.htmlspecialchars_decode($array['Consignee']['City']).'</div>';
			    	$html .= '<div>'.htmlspecialchars_decode($array['Consignee']['CountryName']).'</div>';
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
								'CompanyName'	=> htmlspecialchars($Consignee_CompanyName),
								'AddressLine'	=> htmlspecialchars($Consignee_AddressLine),
								'City'			=> htmlspecialchars($Consignee_City),
								'CountryCode'	=> htmlspecialchars($Consignee_CountryCode),
								'CountryName'	=> htmlspecialchars($Consignee_CountryName),
								'ContactPersonName'		=> htmlspecialchars($Consignee_Contact_PersonName),
								'ContactPhoneNumber'		=> htmlspecialchars($Consignee_Contact_PhoneNumber),
							),
							'Shipper'	=> array(
								'ShipperID'				=> htmlspecialchars($Shipper_ShipperID),
								'CompanyName'			=> htmlspecialchars($Shipper_CompanyName),
								'AddressLine'			=> htmlspecialchars($Shipper_AddressLine),
								'City'					=> htmlspecialchars($Shipper_City),
								'CountryCode'			=> '',
								'CountryName'			=> htmlspecialchars($Shipper_CountryName),
								'ContactPersonName'		=> htmlspecialchars($Shipper_contact_PersonName),
								'ContactPhoneNumber'	=> htmlspecialchars($Shipper_contact_PhoneNumber)
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
								'OutputFullPathPDF' => 'http://dev.af1express.com/uploads/pdf_label/'.$file_name.'.pdf',
							),
							'Label'	=> array(
								'LabelTemplate'=>''
							)
		    			)
		    		);
		    		
				}else{
					$result_xml_return = array(
		    			'Response' => array(
		    				'ServiceHeader' => array(
		    					'MessageTime' => $date_now
		    				),
		    				'Status' => array( 
		    					'ActionStatus' => 'Error',
		    					'Condition' => array(
		    						'ConditionCode' => 401,
		    						'ConditionData' => 'Unauthorized client error status response code indicates that the request has not been applied because it lacks valid authentication credentials for the target resource'
		    					)
		    				)
		    			)
		    		);
				}
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
	    	}
    		$xml = new SimpleXMLElement('<req:ShipmentRequest xsi:schemaLocation="http://www.dhl.com ship-val-global-req.xsd" schemaVersion="6.2" xmlns:req="http://www.dhl.com" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"/>'); 
			array_to_xml($result_xml_return, $xml);
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
	    		if($result_insert_log_booking['result']){
					$result_xml_return = array(
		    			'Response' => array(
		    				'ServiceHeader' => array(
		    					'MessageTime' 		=> $date_now,
		    					'MessageReference' 	=> '',
		    					'SiteID'			=> ''
		    				),
		    				'AWBNumber'			=> '',
		    				'Status'			=> array(
		    					'ActionStatus' => ''
		    				),
		    				'ShipmentInfo'		=> array(
		    					'OriginServiceArea' => array(
		    						'ServiceAreaCode' 	=> '',
		    						'Description'		=> '',
		    					),
		    					'OriginServiceArea' => array(
		    						'Description'	=> '',
		    					),
		    					'DestinationServiceArea' => array(
		    						'ServiceAreaCode' => '',
		    						'Description'	=> ''
		    					),
								'ShipperName' 					=> '',
								'ShipperAccountNumber' 			=> '',
								'ConsigneeName' 				=> '',
								'ShipmentDate' 					=> '',
								'Pieces' 						=> '',
								'Weight' 						=> '',
								'WeightUnit' 					=> '',
								'GlobalProductCode' 			=> '',
								'ShipmentDesc' 					=> '',
								'DlvyNotificationFlag' 			=> '',
								'Shipper' => array(
									'city' 			=> '',
									'CountryCode' 	=> ''
								),
								'Consignee' => array(
									'city' 			=> '',
									'CountryCode' 	=> ''
								),
								'ShipperReference' => array(
									'ReferenceID' 	=> ''
								),
								'ShipmentEvent' 				=> '',
								'Date' 							=> '',
								'Time' 							=> '',
								'EventCode' 					=> '',
								'Description' 					=> '',
								'Signatory' 					=> '',
								'ServiceAreaCode' 				=> '',
								'Description' 					=> '',
		    				),
		    			)
		    		);
		    		
				}else{
					$result_xml_return = array(
		    			'Response' => array(
		    				'ServiceHeader' => array(
		    					'MessageTime' => $date_now
		    				),
		    				'Status' => array(
		    					'ActionStatus' => 'Error',
		    					'Condition' => array(
		    						'ConditionCode' => 401,
		    						'ConditionData' => 'Unauthorized client error status response code indicates that the request has not been applied because it lacks valid authentication credentials for the target resource'
		    					)
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
	    				),
	    				'Status' => array(
	    					'ActionStatus' => 'Error',
	    					'Condition' => array(
	    						'ConditionCode' => 107,
	    						'ConditionData' => 'Incorrect or Incomplete Input Parameters:Failed to read the request message',
	    						'LanguageCode'	=> ''
	    					)
	    				)
	    			)
	    		);
	    	}
	    	$xml = new SimpleXMLElement('<req:StatusRequest xsi:schemaLocation="http://www.dhl.com ship-val-global-req.xsd" schemaVersion="6.2" xmlns:req="http://www.dhl.com" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"/>'); 
			array_to_xml($result_xml_return, $xml);
			$domxml = new DOMDocument('1.0');
			$domxml->preserveWhiteSpace = false;
			$domxml->formatOutput = true;
			$domxml->loadXML($xml->asXML());
			echo $domxml->saveXML();
	    }
	}
?>