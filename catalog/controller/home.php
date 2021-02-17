<?php 
	class HomeController extends Controller {
	    public function index() {
	    	$data = array();
	    	$data['result'] = '';
	    	$data['title']	= '';
	    	// if(method_post()){
		    	$url = "http://brightstar.af1express.com/index.php?route=api";
		    	$input_text = post('testtext');
		    	$result = test_api($url,$input_text);
		    	$data['result'] = $result;
		    // }
		    $this->view('home',$data);
	    }
	}
	function test_api($url,$input_data){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_PORT => "80",
		  CURLOPT_URL => $url ,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => $input_data,
		  CURLOPT_HTTPHEADER => array(
		    "Cache-Control: no-cache",
		    "Content-Type: application/xml"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  return $response;
		}
	}
?>