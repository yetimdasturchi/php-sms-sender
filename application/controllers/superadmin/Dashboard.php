<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();
        $this->load->model('superadmin/superadmin_model', 'superadmin');
        redirect(base_url('sms/records'));
    }

	public function index()
	{
		$this->superadmin->showView('dashboard/main', [
            'section_title' => lang_item('dashboard'),
            'section_breadcrumb' => [
                ['url' => base_url(), 'text' => base_host()],
                ['text' => lang_item('dashboard')],
            ]
        ]);
	}
}
