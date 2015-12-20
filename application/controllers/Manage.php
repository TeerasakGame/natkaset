<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include("Location.php");
class Manage extends Location {

	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in') != TRUE){
            redirect('auth/login');
        }
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
                        'sel_time_create' => date("Y-m-d H:i:s"),
    				);
    		$this->manage->update_sell($sel_id,$data);
    		redirect('manage/sell');
    	}else{
    		echo "ไม่มีสิทธิ์ปิดการขาย";
    	}
    }

    public function edit_sell($sel_id)
    {
        $mem_id = $this->session->userdata('mem_id');
        $check = $this->manage->check_sell($mem_id,$sel_id);
        $data['sell'] = $this->manage->get_sell_id($sel_id);
        if($check == true){
            $data['content_text'] = 'แก้ไขรายละเอียด "'.$data['sell'][0]['sel_topic'].'"';
            $data['type'] = $this->sell->get_type();
            $data['price']= $this->sell->get_price($sel_id);
            $data['cat_parent'] = $this->manage->get_parent($data['sell'][0]['cat_id']);
            $data['parent'] = $this->manage->get_parent($data['cat_parent'][0]['cat_parent']);
            $data['category_1'] = $this->manage->get_category_not_val($data['parent'][0]['cat_code']);
            $data['category_2'] = $this->manage->get_category_not_val2($data['parent'][0]['cat_code'],$data['sell'][0]['cat_id']);
            
            if($data['sell'][0]['typ_id'] == 3 ){
                $data['content_view'] = 'v_edit_guide';
            }else{
                $data['content_view'] = 'v_edit_sell';
            }
            $this->load->view('default',$data);
        }else{
            echo "ไม่มีสิทธิ์แก้";
        }
    }

    public function update_sell()
    {
        $sel_id = $this->input->post('sel_id');
        $cate = $this->input->post('cate');
        $cate2 = $this->input->post('cate2');
        $topic = $this->input->post('topic');
        //$type = $this->input->post('type');
        $type_1 = $this->input->post('type_1');
        $type_2 = $this->input->post('type_2');
        $explan = $this->input->post('explan');
        $price = $this->input->post('price');
        $unit = $this->input->post('unit');
        $address = $this->input->post('address');
        $promotion = $this->input->post('promotion');
        $pro_start = $this->input->post('pro_start');
        $pro_end = $this->input->post('pro_end');
        $lat = $this->input->post('lat_value');
        $lon = $this->input->post('lon_value');

        $mem_id = $this->session->userdata('mem_id');
            
            if($address == 1){
                $longitude = $lon;
                $lagitude = $lat;
            }else{
                $lon = $this->sell->get_location($mem_id,3)->result_array();
                $lat = $this->sell->get_location($mem_id,4)->result_array();
                $longitude = $lon[0]['con_data'];
                $lagitude = $lat[0]['con_data'];
            };

            $name_address = $this->get_name_latlng($lagitude,$longitude);

            $tambon = $name_address['tambon'];
            $amphoe = $name_address['amphoe'];
            $changwat = $name_address['changwat'];

            if($type_1 != null && $type_2 != null){
                $type = 4;
            }
            if($type_1 == null && $type_2 != null){
                $type = 2;
            }
            if($type_1 != null && $type_2 == null){
                $type = 1;
            }
            if($type_1 == null && $type_2 == null){
                $type = 3;
            }

            $data = array(
                'sel_topic' => $topic,
                'sel_explain' => $explan,
                //'sel_price' => $price,
                'sel_time_edit' => date("Y-m-d H:i:s"),
                'sel_status' => 1,
                'cat_id' => $cate2,
                'typ_id' => $type,
                'mem_id' => $mem_id,
                'sel_longitude' => $longitude,
                'sel_lagitude' => $lagitude,
                'sel_promotion' => $promotion,
                'sel_pro_start' => $pro_start,
                'sel_pro_stop' => $pro_end,
                'sel_tambon' => $tambon,
                'sel_amphoe'=> $amphoe,
                'sel_changwat' => $changwat,
                );

            $this->manage->update_sell($sel_id,$data);
            
            if($type == 3){
                $data_price = array(
                            'pri_price' => $price,
                            'pri_unit' => $unit, 
                        );
                 $this->manage->update_price($sel_id,$data_price);
            }

            if($type_1 != null){
                $check_price = $this->manage->check_price($sel_id,$type_1);
                if($check_price == false){
                    $data_price1 = array(
                                'pri_price' => $this->input->post('price_typ1'),
                                'pri_unit' => $this->input->post('unit_typ1'),
                                'typ_id' => $type_1,
                                'sel_id' => $sel_id,
                            );
                    $this->sell->add_price($data_price1);
                }else{
                    $data_price1 = array(
                                'pri_price' => $this->input->post('price_typ1'),
                                'pri_unit' => $this->input->post('unit_typ1'),
                            );
                    $this->manage->update_price2($sel_id,$type_1,$data_price1);
                }
                
            }else{
                $this->manage->del_price($sel_id,1);
            }
            if($type_2 != null){
                $check_price = $this->manage->check_price($sel_id,$type_2);
                if($check_price == false){
                    $data_price2 = array(
                                'pri_price' => $this->input->post('price_typ2'),
                                'pri_unit' => $this->input->post('unit_typ2'),
                                'typ_id' => $type_2,
                                'sel_id' => $sel_id,
                            );
                    $this->sell->add_price($data_price2);
                }else{
                    $data_price2 = array(
                                'pri_price' => $this->input->post('price_typ2'),
                                'pri_unit' => $this->input->post('unit_typ2'),
                            );
                    $this->manage->update_price2($sel_id,$type_2,$data_price2);
                }
            }else{
                $this->manage->del_price($sel_id,2);
            }
                

            $pic_del = $this->sell->get_pic($sel_id);

            foreach ($pic_del as $key) {
                unlink ($key['pic_path']);
                $this->manage->del_pic($key['pic_id']);
            }

            $num = count($_FILES["pic"]["name"]);
            //echo "pic:".$num;
            for ($i=0; $i < $num; $i++) { 
                //echo $_FILES["pic"]["name"][$i];
                $files = $_FILES['pic'];
                $Path = 'image_topic';                  
                $filename = $files['name'][$i];
                $filenameDB = $Path.'/'.date('Ymd').'_'.uniqid(date('Hms')).'_'.$mem_id.'.png';
                copy($files['tmp_name'][$i],$filenameDB);

                if($pic_num == $i){
                    //echo "555555"; die;
                    $data_pic = array(
                        'sel_pic' => $filenameDB,
                        );
                    $this->sell->update_sell($sel_id,$data_pic);
                }

                $data_pic = array(
                        'pic_path' => $filenameDB,
                        'pic_degree' => $i+1,
                        'sel_id' => $sel_id,
                    );

                $this->sell->add_pic($data_pic);

            }

            redirect('manage/sell');

    }

    public function set_time()
    {
        $mem_id = $this->session->userdata('mem_id');
        $time = $this->manage->get_time($mem_id);
        if( $time[0]['time'] <= 0 ){
            echo null;
        }else{
            echo '<span class="badge pull-right" data-toggle="tooltip" title="หมดเวลาการขาย">'.$time[0]['time'].'</span>';
        }
        
    }



}