<?php
	class M_home extends CI_Model {

	    function get_data($id)
	    {
	    	$sql = "SELECT * FROM nat_member WHERE mem_id = ?  LIMIT 1"; 
			$query = $this->db->query($sql, array($id));
			return $query;
	    }

	    function save_contact($data){
	    	$this->db->insert('nat_contact', $data); 
	    }

	    function update_profile($data){
	    	$this->db->where('mem_id',$this->session->userdata('mem_id')) ;
	    	$this->db->update('nat_member', $data);
	    }  
	}
?>