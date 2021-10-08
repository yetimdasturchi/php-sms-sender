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

	public function test()
	{
		
		$this->db->where('approve', '1');
		$this->db->like('title', 'q');
		$this->db->or_like('descr', 'q');
		$this->db->or_like('keywords', 'q');
		$this->db->or_like('alt_name', 'q');
		$this->db->limit(10);
		$this->db->order_by('date', 'desc');
		$query = $this->db->get('dle_post');
	}
}
