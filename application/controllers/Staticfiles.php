<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staticfiles extends CI_Controller {

	public function index()
	{
		redirect( base_url() );
	}

	public function language_js()
	{
		$this->output->set_content_type('application/javascript', 'UTF-8');
		//header("Cache-Control: max-age=604800, public");
		$siteLang = $this->lang->language;
		$result = "backSet.language = ";
		$result .= json_encode($siteLang);
		$result .= ";";
		echo $result;
	}

	public function settings_js()
	{
		$this->output->set_content_type('application/javascript', 'UTF-8');
		//header("Cache-Control: max-age=604800, public");
		$this->load->view('staticfiles/settings');
	}

	public function all_js()
	{
		$this->output->set_content_type('application/javascript', 'UTF-8');
		echo $this->load->view('staticfiles/settings', [], TRUE).PHP_EOL;
		//header("Cache-Control: max-age=604800, public");
		$siteLang = $this->lang->language;
		$result = "backSet.language = ";
		$result .= json_encode($siteLang);
		$result .= ";";
		echo $result;
	}
}
