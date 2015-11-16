<?php
	Class M_service extends CI_model{
		public function check_register($username){
			$sql = "SELECT * FROM nat_member WHERE mem_user_name = '".$username."'";
			return $this->db->query($sql)->result_array();
		}
		public function insert_register($data){
			//$sql = "INSERT INTO member VALUES('','".$username."','".$password"')";
			$this->db->insert('nat_member',$data);
		}
		
		public function check_login($username,$password){
			$sql = "select * FROM nat_member WHERE mem_user_name = '".$username."' AND mem_password = '".$password."'";
			return $this->db->query($sql)->result_array();
		}
		public function load_profile_pic($username){
			$sql = "SELECT mem_first_name,mem_last_name,mem_pic From nat_member WHERE mem_user_name = '".$username."'";
			return $this->db->query($sql)->result_array();
			
		}
		public function query_pkuser($username){
			$sql = "SELECT mem_id FROM nat_member WHERE mem_user_name = '".$username."'";
			return $this->db->query($sql)->result_array();
		}
		public function insert_create_topic($create_topic){
			$this->db->insert('nat_sell',$create_topic);
			
		}
		public function insert_pic_topic($pic){
			$this->db->insert('nat_picture',$pic);
		}
		public function query_sell(){
			$sql = "SELECT * FROM nat_sell ORDER BY sel_pro_start DESC";
			return $this->db->query($sql)->result_array();
		}
	}
?>	