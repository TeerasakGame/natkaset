<?php
	class M_auth extends CI_Model {

	    function __construct()
	    {
	        parent::__construct();
	    }

	    function check_email($email)
	    {
	    	$sql = "SELECT * FROM nat_member WHERE mem_email = ?  LIMIT 1"; 
			$query = $this->db->query($sql, array($email));
			return $query;
	    }

	    function add_member($data)
	    {
	    	$this->db->insert('nat_member', $data); 
			$id = $this->db->insert_id();
	    	return $id;
	    }

	    function check_login($email)
	    {
	    	$sql = "SELECT mem_email,mem_password FROM nat_member WHERE mem_email = ?"; 
			$query = $this->db->query($sql, array($email));
			return $query;
	    }

	    function get_status_concact()
	    {
	    	$sql = "SELECT * FROM nat_member WHERE mem_status = 0"; 
			$query = $this->db->query($sql);
			return $query;
	    }
		
		function check_status($mem_id)
		{
			$sql = "SELECT * FROM nat_member WHERE mem_id = ?";
			$query = $this->db->query($sql, array($mem_id));
			$data = $query->result_array();
			if($data[0]['mem_status'] == '0'){
				return true;
			}else{
				return false;
			}
		}
	}
?>