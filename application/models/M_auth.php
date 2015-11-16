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
	}
?>