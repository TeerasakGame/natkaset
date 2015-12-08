<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include('Location.php');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
      /*  if($this->session->userdata('logged_in') != TRUE){
            redirect('auth/login');
        }*/
        $this->load->model('m_home','home');
    }

	public function index()
	{
        if($this->session->userdata('status_concact') == 0){
            if($this->session->userdata('id_facebook') != Null){
                $this->set_contact();
            }else{
               $this->set_contact(); 
            }   
        }else{
            $data['content_text'] = 'หน้าแรก';
            $data['test'] = '5555555555555555';
            $data['content_view'] = 'test';
            $this->load->view('default',$data);
        }
       
	}

    public function set_contact()
    {
        $data['content_text'] = 'ตั้งค่าข้อมูลที่ใช้ในการติดต่อในการซื้อขาย';
        $data['content_view'] = 'v_set_concact';

        $data['data'] = $this->home->get_data($this->session->userdata('mem_id'))->result_array();

       /* $f_name = $this->input->post('f_name');
        $l_name = $this->input->post('l_name');
        $email = $this->input->post('email');
        $tel = $this->input->post('tel');
        $lat = $this->input->post('lat_value');
        $lon =$this->input->post('lon_value');

        echo $f_name." ".$l_name." ".$email." ".$lat." ".$lon;
        print_r($tel); */

        $this->load->view('no_menu',$data);
    }

   

    public function contact()
    {
       //$data['content_text'] = 'ตั้งค่าข้อมูลที่ใช้ในการติดต่อในการซื้อขาย';

        $f_name = $this->input->post('f_name');
        $l_name = $this->input->post('l_name');
        $email = $this->input->post('email');
        $tel = $this->input->post('tel');
        $lat = $this->input->post('lat_value');
        $lon =$this->input->post('lon_value');
        
       /* echo $f_name." ".$l_name." ".$email." ".$lat." ".$lon;
        print_r($tel); */

        //$data['count_tel'] = count($tel);


/*
        $this->form_validation->set_rules('f_name', 'ชื่อ', 'required');
        $this->form_validation->set_rules('l_name', 'นามสกุล', 'required');
        $this->form_validation->set_rules('email', 'อีเมล', 'trim|required|valid_email');
        for ($i=0; $i < $data['count_tel']; $i++) { 
            $this->form_validation->set_rules('tel['.$i.']', 'เบอร์โทร', 'required|min_length[9]');
        }
       

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
*/
       /* if($this->form_validation->run() == FALSE){
            $data['tel'] = $tel;
          //  var_dump($data['tel']); die; 
            $data['content_view'] = 'v_set_concact';
            $this->load->view('default',$data);
        }else{*/
            //echo $f_name." ".$l_name." ".$email." ".$lat." ".$lon;
            //print_r($tel);
            $data_mem = array(
                        'mem_first_name'=> $f_name,
                        'mem_last_name' => $l_name,
                        'mem_status' => 1,
                        );
            $this->home->update_profile($data_mem);

            $data_email = array(
                        'con_data'=> $email,
                        'con_type' => 2,
                        'mem_id' => $this->session->userdata('mem_id'),
                        );
            $this->home->save_contact($data_email);

            $data_long = array(
                        'con_data'=> $lon,
                        'con_type' => 3,
                        'mem_id' => $this->session->userdata('mem_id'),
                        );
            $this->home->save_contact($data_long);

            $data_lat = array(
                        'con_data'=> $lat,
                        'con_type' => 4,
                        'mem_id' => $this->session->userdata('mem_id'),
                        );
            $this->home->save_contact($data_lat);

            foreach ($tel as $value) {
                $data_tel = array(
                        'con_data'=> $value,
                        'con_type' => 1,
                        'mem_id' => $this->session->userdata('mem_id'),
                        );
                $this->home->save_contact($data_tel);  
            }; 

            $this->session->set_userdata('status_concact', '1');

            //redirect('home','refresh');
			redirect('sell/feed');
            
       // }
        /*echo $f_name." ".$l_name." ".$email." "." ".$lat." ".$lon;
        print_r($tel);*/
        //$this->load->view('default',$data);
    }

    public function set_pass()
    {
        $data['content_text'] = 'ตั้งค่ารหัสผ่าน';
        $data['content_view'] = 'test';
        $this->load->view('default',$data);
    }

    public function test()
    {
        //echo $_SERVER['REMOTE_ADDR'];
        $lat = $this->input->post('lat');
        $log = $this->input->post('log');
  
       

        $newdata = array(
                   'lat' => $lat,
                   'log' => $log,
               );

        $this->session->set_userdata($newdata);
       
        echo $lat."  ".$log;
    }

    

}//class Home