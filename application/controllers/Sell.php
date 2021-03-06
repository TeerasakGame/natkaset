<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include("Location.php");

class Sell extends Location {

	public function __construct()
    {
        parent::__construct();
        //check login
       /* if($this->session->userdata('logged_in') != TRUE){
            redirect('auth/login');
        }*/
        //load model
        $this->load->model('m_sell','sell');
    }
    /*
    |----------------------------------------------------------
    |   index
    |   หน้าประกาสขายสินค้า
    |----------------------------------------------------------
    */
	public function index()
	{
        if($this->session->userdata('logged_in') != TRUE){
            redirect('auth/login');
        }else{
        //set page view
        $data['content_text'] = 'ประกาศขายสินค้า';
        $data['content_view'] = 'v_sell';
        //$data['content_view'] = 'v_edit_sell';
        //call funtion in model for get TYPE
        $data['type'] = $this->sell->get_type();
        $data['category'] = $this->sell->get_category();
        //print_r($data); die();

        $cate = $this->input->post('cate');
        $cate2 = $this->input->post('cate2');
        $topic = $this->input->post('topic');
        $type_1 = $this->input->post('type_1');
        $type_2 = $this->input->post('type_2');
        $explan = $this->input->post('explan');
       // $pic = $this->input->post('pic');
        $price = $this->input->post('price');
        $address = $this->input->post('address');
        $promotion = $this->input->post('promotion');
        $pro_start = $this->input->post('pro_start');
        $pro_end = $this->input->post('pro_end');
        $lat = $this->input->post('lat_value');
        $lon = $this->input->post('lon_value');



        //print_r($type); die;

       // $this->form_validation->set_rules('cate','ชื่อสินค้า', 'required');
        $this->form_validation->set_rules('topic','หัวข้อ','required');
        //$this->form_validation->set_rules('type','ชนิดการขาย','required');
        $this->form_validation->set_rules('explan','รายละเอียดสินค้า','required');
       // $this->form_validation->set_rules('price','ราคา','required');


        //set div for error 
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');

        if($this->form_validation->run() == FALSE){
            //echo $type_1."  ".$type_2;die;
            $this->load->view('default',$data);
        }else{
            //echo $type_1."  ".$type_2;die;
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
            //echo "<pre>";
    //  print_r($name_address);die;
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

            $data = array(
                'sel_topic' => $topic,
                'sel_explain' => $explan,
                'sel_price' => $price,
                'sel_time_create' => date("Y-m-d H:i:s"),
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
            
           // print_r($data);
            //echo $type_1."  ".$type_2;die;
            $sel_id = $this->sell->add_sell($data);

            if($type_1 != null){
                $data_price1 = array(
                                'pri_price' => $this->input->post('price_typ1'),
                                'pri_unit' => $this->input->post('unit_typ1'),
                                'typ_id' => $type_1,
                                'sel_id' => $sel_id,
                            );
                $this->sell->add_price($data_price1);
            }
            if($type_2 != null){
                $data_price2 = array(
                                'pri_price' => $this->input->post('price_typ2'),
                                'pri_unit' => $this->input->post('unit_typ2'),
                                'typ_id' => $type_2,
                                'sel_id' => $sel_id,
                            );
                $this->sell->add_price($data_price2);
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

                $this->sell->insert_like($sel_id,$mem_id,0);
                
               // echo $filenameDB;
            }

            redirect('sell/feed');
        }

        }
        
        
	}


    public function test_naja()
    {
        $data['content_text'] = 'ประกาศขายสินค้า';

        //call funtion in model for get TYPE
        $data['type'] = $this->sell->get_type();
        $data['category'] = $this->sell->get_category();
        //print_r($data); die();
       // $data['content_text'] = 'ประกาศขายสินค้า';
        //$data['content_data'] = array($a = array('1' =>"6666"),'q' => '5555555555555555');
        $data['content_view'] = 'v_sell2';
        $this->load->view('default',$data);

    }

    public function set_concact()
    {
     echo "555";

    $pic = $this->input->post('pic');
        

    }

    public function get_category()
    {
        $code = $this->input->post('code');
        
        $data = $this->sell->get_sub_category($code)->result_array();

        //var_dump($data); die;
        echo '
           <br> <label>ประเภทย่อย(ชนิดของสินค้า)</label>
            <select id="cate2" class="form-control" name="cate2" required>
                <option value="">---กรุณาเลือก---</option>';
                foreach ($data as $row) { 
                    echo '<option value="'.$row['cat_code'].'">'.$row['cat_name'].'</option>';
                }
            echo '</select>' ;

     //  echo json_encode($data);
    }

    public function guide(){
        
        if($this->session->userdata('logged_in') != TRUE){
            redirect('auth/login');
        }else{

            $data['content_text'] = 'แนะนำสินค้า';
            //$data['content_view'] = 'v_guide';
            $data['content_view'] = 'v_sell2';

            //call funtion in model for get TYPE
            $data['type'] = $this->sell->get_type();
            $data['category'] = $this->sell->get_category();

            $cate = $this->input->post('cate');
            $cate2 = $this->input->post('cate2');
            $topic = $this->input->post('topic');
            $type = $this->input->post('type');
            $explan = $this->input->post('explan');
            $pic_num = $this->input->post('pic_num');
            //$price = $this->input->post('price');
           
            $lat = $this->input->post('lat_value');
            $lon = $this->input->post('lon_value');

            $this->form_validation->set_rules('topic','หัวข้อ','required');
            $this->form_validation->set_rules('explan','รายละเอียดสินค้า','required');
            $this->form_validation->set_rules('price','ราคา','required');

            //set div for error 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');

            if($this->form_validation->run() == FALSE){
                $this->load->view('default',$data);
            }else{
                $mem_id = $this->session->userdata('mem_id');



                $name_address = $this->get_name_latlng($lat,$lon);

                $tambon = $name_address['tambon'];
                $amphoe = $name_address['amphoe'];
                $changwat = $name_address['changwat'];
                
                $data = array(
                    'sel_topic' => $topic,
                    'sel_explain' => $explan,
                    //'sel_price' => $price,
                    'sel_time_create' => date("Y-m-d H:i:s"),
                    'sel_status' => 1,
                    'cat_id' => $cate2,
                    'typ_id' => 3,
                    'mem_id' => $mem_id,
                    'sel_longitude' => $lon,
                    'sel_lagitude' => $lat,
                    'sel_tambon' => $tambon,
                    'sel_amphoe'=> $amphoe,
                    'sel_changwat' => $changwat,
                    );
                
               // print_r($data);

                $sel_id = $this->sell->add_sell($data);

                $data_price = array(
                                'pri_price' => $this->input->post('price'),
                                'pri_unit' => $this->input->post('unit'),
                                'typ_id' => 3,
                                'sel_id' => $sel_id,
                            );
                $this->sell->add_price($data_price);

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
                    
                   // echo $filenameDB;
                }

                redirect('sell/feed');
            }
        }
    }

    public function feed($key=Null)
    {
        $data['content_text'] = 'ฟีดรายการสินค้า';
        
        if($key == Null){
            $key = $this->input->post('key');
            //echo $key;die;
            if($key == Null){
                $data_feed = $this->distance($this->session->userdata('lat'),$this->session->userdata('log'));
            }else{
                if(is_numeric($key) == FALSE){
                    /*$check = $this->sell->check_category_by_name($key);
                    if($check != FALSE){
                        $data_feed = $this->distance($this->session->userdata('lat'),$this->session->userdata('log'),$check[0]['cat_code']);
                    }else{
                        $data_feed = $this->distance($this->session->userdata('lat'),$this->session->userdata('log'),$key);
                    }*/
                   // echo $key;die;
                    $data_feed = $this->distance($this->session->userdata('lat'),$this->session->userdata('log'),$key);
                }else{
                    $data_feed = FALSE;
                }
            }
            
        }else{ 
            if(is_numeric($key) == TRUE){
                $data_feed = $this->distance($this->session->userdata('lat'),$this->session->userdata('log'),$key);
            }
        }

        if($data_feed != FALSE){
            $data['content_view'] = 'v_feed';
            $data['feed_new'] = $data_feed[0];
            $data['feed_distance'] = $data_feed[1];
            $data['feed_like'] = $data_feed[2];
        }else{
            $data['content_view'] = 'v_feed_error';
            
            $data['error'] = "ไม่มีรายการสินค้า";
            
        }

        $check = $this->session->userdata('mem_id');
        
        if($check == Null){
            $this->load->view('default_index',$data);
        }else{
            $this->load->view('default',$data);
        }

        
    }

    public function detail($id)
    {
        $data['content_text'] = 'รายละเอียดสินค้า';
        $data['content_view'] = 'v_detail';
       // $id = $this->input->post('id');
        $data['detail'] = $this->sell->get_detail($id);
        $data['pic'] = $this->sell->get_pic($id);
        $data['price'] = $this->sell->get_price($id);
        $data['contact'] = $this->sell->get_contact($data['detail']['0']['mem_id']);
        $data['resemble'] = $this->sell->get_resemble($data['detail']['0']['sel_id'],$data['detail']['0']['cat_id']);
        $data['like'] = $this->sell->get_like($id,$this->session->userdata('mem_id'));
        $data['comment'] = $this->sell->get_comment($data['detail']['0']['sel_id']);
        //print_r($data['like']);die;
        $data['count_like'] = $this->sell->get_count_like($data['detail']['0']['sel_id']); 
        //$this->load->view('default',$data);

        $check = $this->session->userdata('mem_id');
        
        if($check == Null){
            $this->load->view('default_index',$data);
        }else{
            $this->load->view('default',$data);
        }
    }

    public function detail_android($id)
    {
        $data['content_text'] = 'รายละเอียดสินค้า';
        $data['content_view'] = 'v_detail_android';
       // $id = $this->input->post('id');
        $data['detail'] = $this->sell->get_detail($id);
        $data['pic'] = $this->sell->get_pic($id);
        $data['contact'] = $this->sell->get_contact($data['detail']['0']['mem_id']);

        $this->load->view('no_menu',$data);
    }

    public function like()
    {
        $sel_id = $this->input->post('sel_id');
        $status = $this->input->post('status');
        $mem_id = $this->session->userdata('mem_id');
        //echo $sel_id;
        $check = $this->sell->check_like($sel_id,$mem_id);
        if($check != FALSE){
            //echo "มี";
            //print_r($check);
            if($check[0]['lik_status'] == 0){
                $this->sell->update_like($check[0]['lik_id'],1);
                $count_like = $this->sell->get_count_like($sel_id);
               // echo '<h2><a href="#" id="like"><img src="'.base_url().'upload/img/Like Filled-32.png" id="pic"></a><b>'.' '.$count_like[0]["count_like"].'</b></h2>';
                $data['count'] = $count_like[0]["count_like"];
                $data['src'] = 'upload/img/Like Filled-32.png';
                echo $count_like[0]["count_like"];
            }else{
                $this->sell->update_like($check[0]['lik_id'],0);
                $count_like = $this->sell->get_count_like($sel_id);
                //echo '<h2><a href="#" id="like"><img src="'.base_url().'upload/img/Dis Like Filled-32.png" id="pic"></a><b>'.' '.$count_like[0]["count_like"].'</b></h2>';
                //echo "Update status = 0";
                $data['count'] = $count_like[0]["count_like"];
                $data['src'] = 'upload/img/Like Filled-32.png';
                echo $count_like[0]["count_like"];
            }

        }else{
            if($status == 0){
                $this->sell->insert_like($sel_id,$mem_id,1);
                //echo "Update status = 1";
               $count_like = $this->sell->get_count_like($sel_id);
               //echo '<h2><a href="#" id="like"><img src="'.base_url().'upload/img/Like Filled-32.png" id="pic"></a><b>'.' '.$count_like[0]["count_like"].'</b></h2>';
                $data['count'] = $count_like[0]["count_like"];
                $data['src'] = 'upload/img/Like Filled-32.png';
                echo $count_like[0]["count_like"];
            }else{
                $this->sell->insert_like($sel_id,$mem_id,0);
                //echo "Update status = 0";
                $count_like = $this->sell->get_count_like($sel_id);
                //echo '<h2><a href="#" id="like"><img src="'.base_url().'upload/img/Dis Like Filled-32.png" id="pic"></a><b>'.' '.$count_like[0]["count_like"].'</b></h2>'; 
                $data['count'] = $count_like[0]["count_like"];
                $data['src'] = 'upload/img/Like Filled-32.png';
               echo $count_like[0]["count_like"];
            }
        }
    }

    public function add_comment()
    {
        $sel_id = $this->input->post('sel_id');
        $message = $this->input->post('message');
        $mem_id = $this->session->userdata('mem_id');
        //echo $message." ".$mem_id." ".$sel_id;
        $data = array(
            'com_message' => $message,
            'mem_id' => $mem_id,
            'sel_id' => $sel_id,
            'com_create' => date("Y-m-d H:i:s"),
            );

        $this->sell->insert_comment($data);

        $comment = $this->sell->get_comment($sel_id);

        //echo json_encode($comment);
        foreach ($comment as $key) {
            echo '<li class="media">';
            echo '<div class="media-body">';
            echo '<div class="media">';
            echo '<a class="pull-left" href="#">';
            echo '<img class="media-object img-circle " src="';echo base_url($key["mem_pic"]).'" />';
            echo '</a>';
            echo '<div class="media-body" >';
            echo $key["com_message"];
            echo '<br/>';
            echo '<small class="text-muted">'.$key["mem_first_name"].' '.$key["mem_last_name"].' | '.date("H:m น., d F Y ",strtotime($key["com_create"])).'</small>';
            echo '<hr/></div></div></div></li>';
        }


    }

    public function get_comment()
    {
        $sel_id = $this->input->post('sel_id');
        $comment = $this->sell->get_comment($sel_id);
        if($comment == Null){
            echo "<br><center><h1>--- ไม่มีความคิดเห็น ---</h1></center>";
        }else{
            foreach ($comment as $key) {
            echo '<li class="media">';
            echo '<div class="media-body">';
            echo '<div class="media">';
            echo '<a class="pull-left" href="#">';
            echo '<img class="media-object img-circle " src="';echo base_url($key["mem_pic"]).'" />';
            echo '</a>';
            echo '<div class="media-body" >';
            echo $key["com_message"];
            echo '<br/>';
            echo '<small class="text-muted">'.$key["mem_first_name"].' '.$key["mem_last_name"].' | '.date("H:m น., d F Y ",strtotime($key["com_create"])).'</small>';
            echo '<hr/></div></div></div></li>';
        }
        }
        
    }

    public function update_sell()
    {
       // echo "string";
       // $pic = $this->input->post('pic');
        //print_r($pic);

       

    }




}
