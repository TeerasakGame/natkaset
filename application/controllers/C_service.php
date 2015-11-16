<?php
Class C_service extends CI_controller{
	
		public function service_register(){
			$html = base_url()."image_profile/".$_POST['username'].".png";
			$degrees = $_POST['rotate'];
			$this->load->model('M_service','service');
			$profile = $_POST['profile'];
		    $path = $_SERVER["DOCUMENT_ROOT"]."/natkaset/image_profile/".$_POST['username'].".png";
			file_put_contents($path,base64_decode($profile));
			$this->rotate($path,$degrees);
			$data = array(
				'mem_first_name' => $_POST['firstname'],
				'mem_last_name' => $_POST['lastname'],
				'mem_user_name' => $_POST['username'],
				'mem_password' => $_POST['password'],
				'mem_email' => $_POST['email'],
				'mem_pic' => $html
			);
			$this->service->insert_register($data);
			$result_android['result'] = "true";
			echo json_encode($result_android);
			
			
		}//echo "true";
		
		public function check_username(){
			$username = $_POST['username'];
			$this->load->model('M_service','service');
			if($this->service->check_register($username)){
				$result_android['result'] = "false";
				echo json_encode($result_android);
			}
			else{
				$result_android['result'] = "true";
				echo json_encode($result_android);
			}
		}
		public function login(){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$this->load->model('M_service','service');
			if($this->service->check_login($username,$password)){
				$result_android['result'] = "true";
				echo json_encode($result_android);
			}
			else{
				$result_android['result'] = "false";
				echo json_encode($result_android);
			}
	
		}
		
		public function load_profile(){
			$username = $_POST['username'];
			$this->load->model('M_service','service');
			$result_android['result'] = $this->service->load_profile_pic($username);
			echo json_encode($result_android);
		}
		
		public function rotate($path,$degrees){	
			header('Content-type: image/png');
			$source = imagecreatefrompng($path);	
			$rotate = imagerotate($source,$degrees,0);
			imagepng($rotate,$path);
		}
		
		public function create_topic(){
			$this->load->model('M_service','service');
			
			$lagitude = $_POST['latitude'];
			$longitude = $_POST['longitude'];
			$name_topic = $_POST['name_topic'];
			$detail_item  = $_POST['detail_item'];
			$price = $_POST['price'];
			$category_item = $_POST['category_item'];
			$promotion = $_POST['promotion'];
			$category_sell = $_POST['category_sell'];
			$cover_topic = $_POST['cover_topic'];
			$pic_topic = $_POST['pic_topic'];
			$username = $_POST['username'];
			
			$username = $this->service->query_pkuser($username);
			if(!$promotion == " "){
				$promotion = null;
			}//ในกรณีที่เป็นค่าวาง ให้เปลี่ยน null
			$create_topic = array(
				'sel_topic' => $name_topic,
				'sel_explain' => $detail_item,
				'sel_time_create' => date("Y-m-d H:i:s"),
				'sel_price'=> $price,
				'sel_promotion' => $promotion,
				'sel_longitude' => $longitude,
				'sel_lagitude' => $lagitude,
				'sel_pic' => $this->write_pic($pic_topic[$cover_topic - 1],$username[0]['mem_id']),
				'mem_id' => $username[0]['mem_id']
			); //ใส่ค่าทั้งหมดลงแล้ว insert DB
			$sel_id = $this->service->insert_create_topic($create_topic,$username[0]['mem_id']);
			$cover_topic = $cover_topic - 1 ;
			for($i = 0;$i<count($pic_topic);++$i){
				if($i != $cover_topic){
					$this->write_pic($pic_topic[$i],$username[0]['mem_id']);
				}
			}
			$result_android['result'] = "true";
			echo json_encode($result_android);
		}
		
		
		public function write_pic($pic_topic,$username){
			$path = "image_topic/".date("Ymd")."_".uniqid(date("Hms"))."_".$username.".png";
			file_put_contents($_SERVER["DOCUMENT_ROOT"]."/natkaset/".$path,base64_decode($pic_topic));
			return  base_url()."/".$path;
		}//ไว้อัพโหลดรูป
		
		public function sell(){
			$this->load->model('M_service','service');
			if($this->service->query_sell()){
				$result_android['result'] = $this->service->query_sell();
				echo json_encode($result_android);
				echo count($result_android);
			}else{
				$result_android['result'] = "false";
				echo json_encode($result_android);
			}
		}//เอารายการขายที่ใหม่ที่สุดขึ้นก่อน
		public function direction(){
			$this->load->model('M_service','service');
			$lagitude = 14.0779242 ;//$_POST['latitude'];
			$longitude = 100.6014648; //$_POST['longitude'];
			$result_android['result'] = $this->service->query_sell();
			for($i=0;$i<count($result_android['result']);$i++){
				$url = "http://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lagitude.",".$longitude.
				"&destinations=".$result_android['result'][$i]['sel_lagitude'].",".$result_android['result'][$i]['sel_longitude']."&mode=driving&language=th";
				$jsonfile = file_get_contents($url);
				$jsondata = json_decode($jsonfile);
				$result_android['direction'][$i] =  $jsondata->rows[0]->elements[0]->distance->text ."<br>";
			}
			
			
			
			/*$url = "http://maps.googleapis.com/maps/api/distancematrix/json?origins='".$lagitude."','".$longitude."'&destinations=19.9164122,99.7994852&mode=driving&language=th";
			$jsonfile = file_get_contents($url);
			$jsondata = json_decode($jsonfile);*/
			/*echo "<pre>";
			print_r($jsondata);
			echo $jsondata->rows[0]->elements[0]->distance->text;*/
		}// เอาระยะทางที่ใกล้ที่สุดขึ้นก่อน
		
	}
?>