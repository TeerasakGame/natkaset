<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {

	//|----------------------------------------
	//|	funtion: get_name_latlng
	//|	return: ชื่อตำบล อำเภอ และจังหวัด
	//| example data retun: ตำบล คลองหนึ่ง,อำเภอ คลองหลาง,จังหวัด ปทุมธานี และ ตำบล คลองหนึ่ง อำเภอ คลองหลาง จังหวัด ปทุมธานี
	//|----------------------------------------
	public function get_name_latlng($lat,$lng)
	{
		//url gat data from google API
		$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.'%2C'.$lng.'&language=th';
		//get data Json return form google map Api
		$data = json_decode(file_get_contents($url),true);
		//set data
		/*name_tambon = explode(" ",$data['results'][0]['address_components'][1]['long_name']);
		$name_amphoe = explode(" ",$data['results'][1]['address_components'][1]['long_name']);
		$name_changwat = $data['results'][0]['address_components'][3]['long_name'];*/

		/*$name_tambon = $data['results'][0]['address_components'][1]['long_name'];
		$name_amphoe = $data['results'][1]['address_components'][1]['long_name'];
		$name_changwat = $data['results'][0]['address_components'][3]['long_name'];

		$full_name = $name_tambon." ".$name_amphoe." ".$name_changwat;*/
		//add data to array
		
		//print_r($name);
		//echo array_search('sublocality_level_2',$data);
		//echo count($data['results'][0]['address_components']);
		foreach ($data['results'][0]['address_components'] as $key) {
			//echo $key['long_name'].' / ';
			//echo $key['types'][0];

			if($key['types'][0] == 'sublocality_level_2'){
				$name_tambon = $key['long_name'];
				//echo $name_tambon.'<';
			}
			if($key['types'][0] == 'sublocality_level_1'){
				$name_amphoe = $key['long_name'];
				//echo $name_amphoe.'<';
			}
			if($key['types'][0] == 'administrative_area_level_1'){
				$name_changwat = $key['long_name'];
				//echo $name_changwat.'<';
			}
		}

		$full_name = $name_tambon." ".$name_amphoe." ".$name_changwat;
		$name = array(
			'tambon' => $name_tambon,
			'amphoe' => $name_amphoe,
			'changwat' => $name_changwat,
			'full_name' => $full_name,
			);
	//	echo $data['results'][0]['formatted_address'];
		//echo "<pre>";
		//print_r($name);die;
		return $name;
	}
	//|----------------------------------------
	//|	funtion: get_distance
	//|	return: ระยะทาง ค่าระยะทาง เวลาการเดินทาง วิธีการเดินทาง
	//| example data retun: 181 กม.,180100,2 ชั่วโมง 30 นาที,array(ระยะเวลา,การเดินทาง)
	//|----------------------------------------
	public function get_distance($lat_start,$lng_start,$lat_end,$lng_end)
	{
		$start = $lat_start.'%2C'.$lng_start;
		$end = $lat_end.'%2C'.$lng_end;

		$url = 'https://maps.googleapis.com/maps/api/directions/json?origin='.$start.'&destination='.$end.'&language=th';


		$data = json_decode(file_get_contents($url),true);
		/*echo "<pre>";
			print_r($data);
		echo "</pre>";*/

		$distance_name =  $data['routes'][0]['legs'][0]['distance']['text'];
		$distance_value =  $data['routes'][0]['legs'][0]['distance']['value'];
		$time = $data['routes'][0]['legs'][0]['duration']['text'];
		$journey = $data['routes'][0]['legs'][0]['steps'];
		
		$distance = array(
			'distance_text'=> $distance_name,
			'distance_value' => $distance_value,
			'time' => $time,
			'journey' => $journey,
			);

		/*echo "<pre>";
			print_r($distance);
		echo "</pre>";*/

		return $distance;
	}

	public function distance($lat,$lng)
	{
		$this->load->model('M_sell','sell');

		$data = $this->sell->get_feed_new();

		//print_r($data);die;
		
		$new = array();

		/*foreach ($data as $data) {
			$distance = $this->get_distance($lat,$lng,$data['sel_lagitude'],$data['sel_longitude']);
			//$distance = $this->distance_Server($lat,$lng,$data['sel_lagitude'],$data['sel_longitude']);
			//$loc_name = $this->get_name_latlng($data['sel_lagitude'],$data['sel_longitude']);
			$add = array(
				'sel_id' => $data['sel_id'],
				'sel_topic' => $data['sel_topic'],
				'sel_explain' => $data['sel_explain'],
				'sel_pic' => $data['sel_pic'],
				'sel_price' => $data['sel_price'],
				'sel_time_create' => $data['sel_time_create'],
				'dis_val' => $distance['distance_value'],
				//'dis_text' => $distance['distance_text'],
				//'loc_name' => $loc_name['full_name'],
				//'loc_amphoe' => $loc_name['amphoe'],
				//'loc_changwat' => $loc_name['changwat'],
				);
			array_push($new,$add);
		}*/

		/*echo '<pre>';
		print_r($new);
		echo '</per>';*/
		

		foreach ($data as $key => $row) {
			$distance = $this->distance_1($lat,$lng,$row['sel_lagitude'],$row['sel_longitude']);
			//$distance_a = $this->get_distance($lat,$lng,$row['sel_lagitude'],$row['sel_longitude']);
			//$loc_name = $this->get_name_latlng($data['sel_lagitude'],$data['sel_longitude']);
			$count = $this->sell->get_feed_like($row['sel_id']);

			//print_r($count_like);die;

			$add = array(
				'sel_id' => $row['sel_id'],
				'sel_topic' => $row['sel_topic'],
				'sel_explain' => $row['sel_explain'],
				'sel_pic' => $row['sel_pic'],
				'sel_price' => $row['sel_price'],
				'sel_time_create' => $row['sel_time_create'],
				'sel_status' => $row['sel_status'],
				'dis_val' => $distance,
				//'dis_val' => $distance['distance_value'],
				//'dis_text' => $distance_a['distance_text'],
				//'loc_name' => $loc_name['full_name'],
				//'loc_amphoe' => $loc_name['amphoe'],
				//'loc_changwat' => $loc_name['changwat'],
				'mem_pic' => $row['mem_pic'],
				'mem_first_name' => $row['mem_first_name'],
				'mem_last_name' => $row['mem_last_name'],
				'sel_tambon' => $row['sel_tambon'],
				'sel_amphoe' => $row['sel_amphoe'],
				'sel_changwat' => $row['sel_changwat'],
				'sel_promotion' => $row['sel_promotion'],
				'count_like' => $count[0]['count_like'],
				);
			array_push($new,$add);

		    //$dis_val[$key]  = $distance['distance_value'];
		    $dis_val[$key]  = $distance;
		    $time[$key] = $row['sel_time_create'];
		    $count_like[$key] = $count[0]['count_like'];
		}

		$data = $new;
		$data_like = $new;
		/*echo "<pre>";
		print_r($new);die;*/

		array_multisort($dis_val,SORT_ASC,$time,SORT_DESC,$new);

		array_multisort($count_like,SORT_DESC,$time,SORT_DESC,$data_like);
		//array_multisort($time,SORT_DESC,$new);

		$data_feed = array($data,$new,$data_like);

		//echo '</br>';
		/*echo '<pre>';
		print_r($new);
		echo '</per>';*/
		return $data_feed;
		
		
	}

	public function distance_Server($lat_start,$lng_start,$lat_end,$lng_end)
	{
		$start = $lat_start.','.$lng_start;
		$end = $lat_end.','.$lng_end;

		$url = 'http://router.project-osrm.org/viaroute?loc='.$start.'&loc='.$end;

		$data = json_decode(file_get_contents($url),true);

		$distance_value = $data['route_summary']['total_distance'];
		$time = $data['route_summary']['total_time'];

		$distance = array(
			'distance_value' => $distance_value,
			'time' => $time,
			);

		return $distance;

		/*echo "<pre>";
		print_r($data['route_summary']);*/

	}

	public function distance_1($lat1, $lon1, $lat2, $lon2) 
	{
	  	 $theta = $lon1 - $lon2;
		  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		  $dist = acos($dist);
		  $dist = rad2deg($dist);
		  $miles = $dist * 60 * 1.1515;
		 /* $unit = strtoupper($unit);

		  if ($unit == "K") {
		    return ($miles * 1.609344);
		  } else if ($unit == "N") {
		      return ($miles * 0.8684);
		    } else {
		        return $miles;
		      }*/

		  //echo $miles*1.609344;
		  return number_format($miles*1.609344,2,'.','');
	}

}