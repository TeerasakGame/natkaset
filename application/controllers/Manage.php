<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model('M_manage','manage');
        $this->load->model('M_sell','sell');
           
    }
    public function sell()
    {
    	$data['content_text'] = 'จัดการสินค้าที่ประกาศ';
        $data['content_view'] = 'v_manage_sell';

        $data['sell'] = $this->manage->get_sel_by_id($this->session->userdata('mem_id'));
        
        $this->load->view('default',$data);

    }

    public function close_sel($sel_id)
    {
    	//echo $sel_id;
    	$mem_id = $this->session->userdata('mem_id');
    	$check = $this->manage->check_sell($mem_id,$sel_id);
    	if($check == true){
    		$data = array(
    					'sel_status' => 0, 
    					'sel_time_edit' => date("Y-m-d H:i:s"),
    				);
    		$this->manage->update_sell($sel_id,$data);
    		redirect('manage/sell');
            //redirect('/account/login', 'refresh');

    	}else{
    		echo "ไม่มีสิทธิ์ปิดการขาย";
    	}
    }

    public function open_sel($sel_id)
    {
    	//echo $sel_id;
    	$mem_id = $this->session->userdata('mem_id');
    	$check = $this->manage->check_sell($mem_id,$sel_id);
    	if($check == true){
    		$data = array(
    					'sel_status' => 1, 
    					'sel_time_edit' => date("Y-m-d H:i:s"),
    				);
    		$this->manage->update_sell($sel_id,$data);
    		redirect('manage/sell');
    	}else{
    		echo "ไม่มีสิทธิ์ปิดการขาย";
    	}
    }

    public function edit_sel()
    {
        $data['content_text'] = 'แก้ไขรายละเอียด "ชื่อสินค้า"';
        $data['content_view'] = 'v_edit_sell';
        $data['type'] = $this->sell->get_type();
        $data['category'] = $this->sell->get_category();
        $this->load->view('default',$data);

    }



}