<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gsm extends CI_Controller {

	private $token;

	public function __construct()
    {
    	parent::__construct();

    	header('Content-Type: application/json');
    	$this->config->load('gsm_config');
    	$this->token = $this->input->get('token');
    	if (!array_key_exists($this->token, $this->config->item('modem_tokens'))) {
    		$this->out('error', 'Tokent not found!');
        }
    }
    
	public function index()
	{
		$this->out('error', 'Tokent not found!');
	}

	public function unsended()
	{
		$query = $this->db->select('sms_id as id, sms_date as date, sms_phone as phone, sms_message as message')->from('gsmmessages')
        	->where('sms_status', '0')
        	->where('sms_date <', time())
        	->order_by('sms_importance', 'DESC')
        	->order_by('sms_id', 'ASC')
        	->limit('1')
		->get();

		if ($query->num_rows() > 0 && setting_item('sendingstatus') == 'true') {
			$query = $query->row_array();
			//$this->db->update('gsmmessages', ['sms_senddate' => time(), 'sms_status' => 1], ['sms_id' => $query['id']]);
			$this->out('ok', 'List messages to send', $query);
			//$this->out('error', 'No messages to send!');
		}else{
			$this->out('error', 'No messages to send!');
		}
	}

	public function sended()
	{
		$id = $this->input->get('smsid');
		$query = $this->db->get_where('gsmmessages', ['sms_id' => $id]);
		if ($query->num_rows() > 0) {
			$this->db->update('gsmmessages',[
					'sms_received' => time(),
					'sms_senddate' => time(),
					'sms_status' => 2
				],[
					'sms_id' => $id
			]);
			$this->out('ok', 'Message status changed!');
		}else{
			$this->out('error', 'Message not found!');
		}
	}

	private function out($status='ok', $message='', $data=[], $html='')
	{
		$result['status'] = $status;
		$result['message'] = $message;
		
		if (count($data) > 0) {
			$result['data'] = $data;	
		}

		if ($html != '') {
			$result['html'] = $html;	
		}
		
		die(json_encode($result));
	}
}
