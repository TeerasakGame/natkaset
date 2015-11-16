<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FB_login extends CI_Controller {

	public function index()
	{
		$this->load->library('facebook');

        $user = $this->facebook->getUser();

        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me?fields=id,email,first_name,last_name');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }

        if ($user) {
           // $data['logout_url'] = $this->facebook->getLogoutUrl();
           $data['logout_url'] = $this->facebook->destroySession();
        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array('scope' => 'email'));
        }

        
        $this->load->view('view',$data);
	}

    public function test_template(){
        
        //echo base_url();
        $data['content_text'] = 'content_text';
        $data['test'] = '5555555555555555';
        $data['content_view'] = 'test';
        $this->load->view('default',$data);
    }

    public function loin_facebook()
    {
        $this->load->library('facebook');

        $user = $this->facebook->getUser();

        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me?fields=id,email,first_name,last_name');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }

        if ($user) {
            $data['logout_url'] = $this->facebook->getLogoutUrl();
           // $data['logout_url'] = $this->facebook->destroySession();
        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array('scope' => 'email'));
        }

        
        $this->load->view('test',$data);
    }



}