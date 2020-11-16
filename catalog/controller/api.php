<?php 
	class ApiController extends Controller {
	    public function index() {
	    	$xml_string = file_get_contents('php://input');
	    	if(!empty($xml_string)){
	    		$xml = @simplexml_load_string($xml_string, "SimpleXMLElement", LIBXML_NOCDATA);
	    		$json = json_encode($xml);
				$array = json_decode($json,TRUE);
	   //  		$xmlTest = new SimpleXMLElement('<xmlns:ws:Test>'.$xml_string.'</xmlns:ws:Test>', LIBXML_NOERROR, false, 'ws', true);
				// $xmlTest->addAttribute('xmlns:xmlns:ws', 'http://url.to.namespace');
				// $xmlTest->addAttribute('xmlns:xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
	    		// $xml = new SimpleXMLElement($xml_string);
	    		// $xml = simplexml_load_string($xml_string);
	    		// $array = array(
	    		// 	'SoftwareName'=> ''
	    		// );
	    		$booking = $this->model('booking');
	    		$data_booking = array(
	    			'AccountType' 			=> $array['ShipmentDetails']['AccountType'],
	    			'AccountNumber' 		=> $array['ShipmentDetails']['AccountNumber'],
	    			'BillToAccountNumber' 	=> $array['ShipmentDetails']['BillToAccountNumber'],
	    			'NumberOfPieces' 		=> $array['ShipmentDetails']['NumberOfPieces'],
	    			'Weight' 				=> $array['ShipmentDetails']['Weight'],
	    			'WeightUnit' 			=> $array['ShipmentDetails']['WeightUnit'],
	    			'GlobalProductCode' 	=> $array['ShipmentDetails']['GlobalProductCode'],
	    			'LocalProductCode' 		=> $array['ShipmentDetails']['LocalProductCode'],
	    			'DoorTo' 				=> $array['ShipmentDetails']['DoorTo'],
	    			'DimensionUnit' 		=> $array['ShipmentDetails']['DimensionUnit'],
	    			'Pieces'				=> $array['ShipmentDetails']['Pieces']
	    		);
	    		$result_insert_booking = $booking->insertBooking($data_booking);
	    		// echo json_encode($result_insert_booking);
	    		$xml = new SimpleXMLElement('<root/>');
				array_walk_recursive($data_booking, array ($xml, 'addChild'));
				return $this->xml($xml->asXML());

	    		// var_dump($array['@attributes']);
	    	}
	    }

	}

?>