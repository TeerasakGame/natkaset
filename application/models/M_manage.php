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

	    function get_sell_id($sel_id)
	    {
	    	$sql = "SELECT * FROM nat_sell JOIN nat_category ON nat_category.cat_code = nat_sell.cat_id WHERE nat_sell.sel_id = ?";
	    	$query = $this->db->query($sql,array($sel_id));
	    	return $query->result_array();
	    }

	    function get_category_not_val($cat_code)
	    {
	    	$sql = "SELECT * FROM nat_category WHERE cat_parent is null and cat_code != ?";
	    	$query = $this->db->query($sql,array($cat_code));
	    	return $query->result_array();
	    }

	    function get_category_not_val2($cat_parent,$cat_code)
	    {
	    	$sql = "SELECT * FROM nat_category WHERE cat_parent = ? AND cat_code != ?";
	    	$query = $this->db->query($sql,array($cat_parent,$cat_code));
	    	return $query->result_array();
	    }

	    function get_parent($cat_code)
	    {
	    	$sql = "SELECT * FROM nat_category WHERE cat_code = ?";
	    	$query = $this->db->query($sql,array($cat_code));
	    	return $query->result_array();
	    }

	    function del_pic($id)
	    {
	    	$this->db->where('pic_id', $id);
			$this->db->delete('nat_picture');
	    }

	}
?>