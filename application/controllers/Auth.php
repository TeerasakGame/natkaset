<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  	public function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model('m_auth','auth');
           
    }
    /*
    |--------------------------------------------------------
    |	register
    | 	หน้าสมัครสมาชิกโดยรับค่า POST มาจากหน้า v_register.php แล้วทำการบันทึกใน DB
    |--------------------------------------------------------
    */
	public function register()
	{
		//Set view
		$data['content_text'] = 'สมัครสมาชิก';
		$data['content_view'] = 'v_register';
		//input value from v_register.php
		$f_name = $this->input->post('f_name');
		$l_name = $this->input->post('l_name');
		$email = $this->input->post('email');
		$password1 = $this->input->post('password1');
		$password2 = $this->input->post('password2');
		//check value with libary form_validation
		$this->form_validation->set_rules('f_name', 'ชื่อ', 'required');
		$this->form_validation->set_rules('l_name', 'นามสกุล', 'required');
		$this->form_validation->set_rules('email', 'อีเมล', 'trim|required|valid_email|callback_email_check');
		$this->form_validation->set_rules('password1','รหัสผ่าน','required|min_length[8]|matches[password2]');
		$this->form_validation->set_rules('password2','ยืนยันรหัสผ่าน','required|min_length[8]');
		//set div for error 
		 $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
		//if check validate
		if($this->form_validation->run() == FALSE){
			$this->load->view('default_index',$data);
		}else{
			//--- add member ---
			//set password encrype use libary encrypt	
			$encrypt_password = $this->encrypt->encode($password1);
			$filenameDB = 'upload/img/user.jpg';
			//set data to array
			$data = array(
							'mem_first_name' => $f_name, 
							'mem_last_name' => $l_name,
							'mem_email' => $email,
							'mem_password' => $encrypt_password,
							'mem_status' => 0,
							'mem_pic'=> $filenameDB,
					);
			//cell function in model
			$mem_id = $this->auth->add_member($data);

			$newdata = array(
				                   'username'  => $f_name.' '.$l_name,
				                   'email'     => $email,
				                   'logged_in' => TRUE,
				                   'mem_pic' => $filenameDB,
								   'mem_id' => $mem_id,
               					);

			$this->session->set_userdata($newdata);

			redirect('home/set_contact');

		}
	}
	/*
    |--------------------------------------------------------
    |	email_check
    | 	เช็ค e-mail ใน DB ว่ามีหรือไม่
    |--------------------------------------------------------
    */
	public function email_check($str){
		//call funtion in model
		$data = $this->auth->check_email($str);
		//if check data 
		if($data->num_rows() > 0){
			$this->form_validation->set_message('email_check', 'อีเมล '.$str.' ถูกใช้สมัครไปแล้ว');
			return FALSE;
		}else{
			return TRUE;
		}
	}
	/*
    |--------------------------------------------------------
    |	login
    | 	หน้าเข้าสู่ระบบโดยรับค่า POST จาก v_login.php
    |--------------------------------------------------------
    */
	public function login(){
		if($this->session->userdata('logged_in') == TRUE){
			redirect('sell/feed');
		}else{
			//Set view
			$data['content_text'] = 'เข้าสู่ระบบ';
			$data['content_view'] = 'v_login';
			//input value from v_login.php
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			//check value with libary form_validation
			$this->form_validation->set_rules('email', 'อีเมล', 'trim|required|valid_email');
			$this->form_validation->set_rules('password','รหัสผ่าน','required|callback_login_check');
			//set div for error 
			 $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');

			if($this->form_validation->run() == FALSE){
				$this->load->view('default_index',$data);
			}else{
				$data = $this->auth->check_email($email)->result_array();
				//echo "<pre>";
				//print_r($data);
				//echo $data[0]['mem_pic']; die;
				$newdata = array(
					        	'username'  => $data[0]['mem_first_name'].' '.$data[0]['mem_last_name'],
					        	'email'     => $email,
					        	'logged_in' => TRUE,
					        	'status_concact' =>  $data[0]['mem_status'],
					        	'mem_id' => $data[0]['mem_id'],
					        	'mem_pic' => $data[0]['mem_pic'],
	               			);

				$this->session->set_userdata($newdata);
				$status = $this->auth->check_status($this->session->userdata('mem_id'));
				if($status == true){
					redirect('home/set_contact');
				}else{
					redirect('sell/feed');
				}
				
			}

		}	
	}
	/*
    |--------------------------------------------------------
    |	login_check
    | 	ตรวจสอบ e-mail แล้ว password ในการทำการ Login
    |--------------------------------------------------------
    */
	public function login_check($str){
		//input email from funtion login
		$email = $this->input->post('email');
		//call function in model,set value in data
		$data = $this->auth->check_email($email)->result_array();
		//check data
		if($data==NULL){

			$this->form_validation->set_message('login_check', 'ไม่มีอีเมล '.$email.' ในระบบ');
			return FALSE;
		}else{
			//decode password
			$password = $this->encrypt->decode($data[0]['mem_password']);
			if($password != $str){
				$this->form_validation->set_message('login_check', 'รหัสผ่านไม่ถูกต้อง กรุณากรอกใหม่');
				return FALSE;
			}else{
				return TRUE;
			}
		}
	}
	/*
    |--------------------------------------------------------
    |	login_facebook
    | 	เข้าสู่ระบบด้วย facebook รับค่าจากชื่อ อีเมล จาก Api 
    |--------------------------------------------------------
    */
    public function login_facebook(){
    	if($this->session->userdata('logged_in') == TRUE){
			redirect('sell/feed');
		}else{
	    	//load facebook library
	    	$this->load->library('facebook');
	    	//get user from facebook
	    	$user = $this->facebook->getUser();
	    	//get and set access_token
	    	$access_token = $this->facebook->getAccessToken();
	    	$this->facebook->setAccessToken($access_token);

	    	if ($user) {
	            try{
	            	//get profile
	                $data = $this->facebook->api('/me?fields=id,email,first_name,last_name');
	                //check email in database
	                $check = $this->auth->check_email($data['email'])->result_array();
	                //print_r($check); die;
	               	
					//if have email do 
	                if($check != NULL){
	                	//set session
		                $newdata = array(
						                   'username'  => $data['first_name'].' '.$data['last_name'],
						                   'email'     => $data['email'],
						                   'id_facebook' => $data['id'],
						                   'logged_in' => TRUE,
						                   'status_concact' => $check[0]['mem_status'],
						                   'mem_id' => $check[0]['mem_id'],
						                   'mem_pic' => $check[0]['mem_pic'],
		               					);

						$this->session->set_userdata($newdata);

	                	redirect('sell/feed');
					}else{
						$Path = 'image_profile';                  
                		$filenameDB = $Path.'/'.date('Ymd').'_'.uniqid(date('Hms')).'_'.$data['id'].'.png';
                		$arrContextOptions=array(
						    "ssl"=>array(
						        "verify_peer"=>false,
						        "verify_peer_name"=>false,
						    ),
						);
                		// Your file
						$file = 'http://graph.facebook.com/'.$data['id'].'/picture?type=large';
						// Open the file to get existing content
						$data_pic = file_get_contents($file, false, stream_context_create($arrContextOptions));;
						// New file
						$new = $filenameDB ;
						// Write the contents back to a new file
						file_put_contents($new, $data_pic);
	                	
	                	$data_add = array(
									'mem_first_name' => $data['first_name'], 
									'mem_last_name' => $data['last_name'],
									'mem_email' => $data['email'],
									'mem_access_token' => $access_token,
									'mem_status' => 0,
									'mem_pic'=> $filenameDB,
								);
						//cell function in model from input data
						$this->auth->add_member($data_add);

						$check1 = $this->auth->check_email($data_add['mem_email'])->result_array();

		               	//set session
		                $newdata = array(
		                					'username'  => $check1[0]['mem_first_name'].' '.$check1[0]['mem_last_name'],
					        				'email'     => $check1[0]['mem_email'],
					        				'id_facebook' => $data['id'],
					        				'logged_in' => TRUE,
						                  	'status_concact' => $check1[0]['mem_status'],
						                   	'mem_id' => $check1[0]['mem_id'],
						                   	'mem_pic'=> $check1[0]['mem_pic'],
		               					);

						$this->session->set_userdata($newdata);

						//redirect('sell/feed');
						$status = $this->auth->check_status($this->session->userdata('mem_id'));
						if($status == true){
							redirect('home/set_contact');
						}else{
							redirect('sell/feed');
						}
					} 
	            }catch (FacebookApiException $e) {
	                $user = null;
	            }
	        }else{
	        	//login with facebook
	        	//die("<script>top.location='".$this->facebook->getLoginUrl(array('scope' => 'email','redirect_url' => 'base_url()index.php/auth/login_facebook'))."'</script>");
				die("<script>top.location='".$this->facebook->getLoginUrl(array('scope' => 'email'))."'</script>");
	        }
	    }
    }

    public function logout(){
    	$this->load->library('facebook');
    
    	$this->facebook->destroySession();
    	$this->session->sess_destroy();

    	redirect('auth/login','refresh');

    }

}