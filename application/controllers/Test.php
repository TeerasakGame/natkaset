<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{
		//header('Content-type: application/json');

		$Data = json_decode(file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng=16.17430696001645%2C99.77628707885742&sensor=true'),true);
		echo '<pre>';
			//print_r($Data);
		echo '</pre>';
		//echo $Data['formatted_address'];
		echo "ตำบล : ".$Data['results'][0]['address_components'][1]['long_name'];
		echo " อำเภอ : ".$Data['results'][0]['address_components'][2]['long_name'];
		echo " จังหวัด : ".$Data['results'][0]['address_components'][3]['long_name'];
		echo "</br>";
		echo $Data['results'][0]['formatted_address'];


	}

}