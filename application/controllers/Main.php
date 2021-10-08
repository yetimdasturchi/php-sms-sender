<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();

    	if ($this->uri->segment(1) != 'logout' && $this->session->has_userdata('user_phone') && $this->session->has_userdata('logged')) {
    		if ($this->session->userdata('logged') == TRUE) {
    			redirect( base_url('dashboard') );
    		}
    	}
    }

	public function index()
	{
		redirect( base_url('login') );
	}

	public function login()
	{
		$this->load->view('main/login');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect( base_url('login') );
	}
}
