<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {

	public function index()
	{
		redirect( base_url('login') );
	}

	public function error()
	{
		$this->load->view('main/error');
	}
}
