<?php
	class M_manage extends CI_Model {

		function get_sel_by_id($mem_id)
	    {
	    	$sql = "SELECT * FROM nat_sell WHERE mem_id = ? ORDER BY sel_time_create DESC";
	    	$query = $this->db->query($sql,array($mem_id));
	    	return $query->result_array();
	    }

	    function check_sell($mem_id,$sel_id)
	    {
	    	$sql = "SELECT * FROM nat_sell WHERE mem_id = ? AND sel_id = ?";
	    	$query = $this->db->query($sql,array($mem_id,$sel_id));
	    	if($query->num_rows() > 0){
	    		return true;
	    	}else{
	    		return false;
	    	}
	    }

	    function update_sell($sel_id,$data)
	    {
	    	$this->db->where('sel_id',$sel_id) ;
	    	$this->db->update('nat_sell', $data);
	    }


	}
?>