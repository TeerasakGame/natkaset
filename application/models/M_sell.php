<?php
	class M_sell extends CI_Model {

	    function __construct()
	    {
	        parent::__construct();
	    }

	    function get_type()
	    {
	    	$sql = "SELECT * FROM nat_type WHERE typ_name != 'แนะนำสินค้า'"; 
			$query = $this->db->query($sql);
			return $query;
	    }

	    function get_category()
	    {
	    	//$sql = "SELECT * FROM nat_category WHERE cat_prrent IS NOT NULL ORDER BY cat_name ASC";
	    	$sql = "SELECT * FROM nat_category WHERE cat_parent IS NULL";
	    	$query = $this->db->query($sql);
			return $query;
	    }

	    function get_sub_category($code)
	    {
	    	$sql = "SELECT * FROM nat_category WHERE cat_parent = ?";
	    	$query = $this->db->query($sql,array($code));
			return $query;
	    }

	    function add_sell($data)
	    {
	    	$this->db->insert('nat_sell', $data); 
	    	$id = $this->db->insert_id();
	    	return $id;
	    }
	    
	    function get_location($id,$type)
	    {
	    	$sql = "SELECT * FROM nat_contact WHERE mem_id = ? and con_type = ?";
	    	$query = $this->db->query($sql,array($id,$type));
			return $query;
	    }

	    function add_pic($data)
	    {
	    	$this->db->insert('nat_picture', $data); 
	    }

	    function update_sell($id,$data)
	    {
	    	$this->db->where('sel_id',$id) ;
	    	$this->db->update('nat_sell', $data);
	    }

	    function get_feed_new()
	    {
	    	$sql = "SELECT * FROM nat_sell JOIN nat_member ON nat_member.mem_id = nat_sell.mem_id ORDER BY nat_sell.sel_time_create DESC";
	    	$query = $this->db->query($sql);
			return $query->result_array();
	    }

	    function get_feed_popular()
	    {
	    	$sql = "";
	    	$query = $this->db->query($sql);
			return $query->result_array();
	    }

	    function get_detail($id)
	    {
	    	$sql = "SELECT * FROM nat_sell JOIN nat_member on nat_member.mem_id = nat_sell.mem_id JOIN nat_type on nat_type.typ_id = nat_sell.typ_id WHERE sel_id = ?";
	    	$query = $this->db->query($sql,array($id));
	    	return $query->result_array();
	    }

	    function get_pic($id)
	    {
	    	$sql = "SELECT * FROM nat_picture WHERE sel_id = ?";
	    	$query = $this->db->query($sql,array($id));
	    	return $query->result_array();
	    }

	    function get_contact($id)
	    {
	    	$sql = "SELECT * FROM nat_contact WHERE mem_id = ? AND (con_type = '1' or con_type = '2') ORDER BY con_type ASC";
	    	$query = $this->db->query($sql,array($id));
	    	return $query->result_array();
	    }

	    function get_resemble($sel_id,$cat_id)
	    {
	    	$sql = "SELECT * FROM nat_sell WHERE cat_id = ? AND sel_id != ? LIMIT 5;";
	    	$query = $this->db->query($sql,array($cat_id,$sel_id));
	    	return $query->result_array();
	    }

	    function get_like($sel_id,$mem_id)
	    {
	    	$sql = "SELECT * FROM nat_like WHERE sel_id = ? and mem_id = ?";
	    	$query = $this->db->query($sql,array($sel_id,$mem_id));
	    	if($query->num_rows() > 0){
	    		return $query->result_array();
	    		//return "true";
	    	}else{
	    		return false;
	    	}
	    }

	    function get_count_like($sel_id)
	    {
	    	$sql = "SELECT COUNT(sel_id) as count_like FROM nat_like WHERE sel_id = ? and lik_status = 1";
	    	$query = $this->db->query($sql,array($sel_id));
	    	return $query->result_array();
	    }

	    function check_like($sel_id,$mem_id)
	    {
	    	$sql = "SELECT * FROM nat_like WHERE sel_id = ? AND mem_id = ?";
	    	$query = $this->db->query($sql,array($sel_id,$mem_id));
	    	//return $query->result_array();
	    	if($query->num_rows() > 0){
	    		//return true;
	    		return $query->result_array();
	    	}else{
	    		return false;
	    	}

	    }

	    function insert_like($sel_id,$mem_id,$status)
	    {
	    	$data = array(
	    			'sel_id' => $sel_id, 
	    			'mem_id' => $mem_id,
	    			'lik_status' => $status,  
	    			);
	    	$this->db->insert('nat_like', $data);
	    }

	    function update_like($lik_id,$status)
	    {
	    	$data = array(
	    			'lik_status' => $status,  
	    			);
	    	$this->db->where('lik_id',$lik_id) ;
	    	$this->db->update('nat_like', $data);
	    }

	    function get_feed_like($sel_id)
	    {
	    	$sql = "SELECT SUM(nat_like.lik_status) as count_like FROM nat_sell
					JOIN nat_like on nat_like.sel_id = nat_sell.sel_id
					WHERE nat_sell.sel_id = ?
					GROUP BY nat_sell.sel_id
					ORDER BY count_like DESC";
	    	$query = $this->db->query($sql,array($sel_id));
	    	return $query->result_array();
	    }
	    
	}
?>