<?php

Class Sms_model extends CI_Model {

	public function send($phone='', $message='', $importance=0)
	{
		$data = [
			'sms_importance' => $importance,
			'sms_date' => time(),
			'sms_senddate' => 0,
			'sms_senddate' => 0,
			'sms_received' => 0,
			'sms_phone' => $phone,
			'sms_message' => $message,
		];
		
		$this->db->insert('gsmmessages', $data);
		return $data;
	}

	public function send_template($phone='', $templatename='', $data=[], $importance=0)
	{
		$template = $this->db->get_where('gsmtemplates', [
			'smstemplate_key' => $templatename
		]);
		if ($template->num_rows() > 0) {
			$template = $template->row_array();
			$message = $this->parser->parse_string($template['smstemplate_text'], $data, TRUE);
			$this->send($phone, $message, $importance);
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function benchmark($str='', $data=[])
	{
		preg_match_all('/\{(.+?)(\=(.+?)|)\}/m', $str, $matches, PREG_SET_ORDER);
		foreach ($matches as $match) {
			if (array_key_exists('1', $match)) {
				if (array_key_exists('3', $match)) {
					if ($match[1] == 'date') {$match[1] = date($match[3]);}
					if ($match[1] == 'rstring') {$match[1] = generateRandomString($match[3]);}
					if ($match[1] == 'rnumber') {$match[1] = generateNumericOTP($match[3]);}
					$str = str_replace($match[0], $match[1], $str);
				}else{
					if ($match[1] == 'date') {$match[1] = date("Y-m-d | H:i:s");}
					if ($match[1] == 'rstring') {$match[1] = generateRandomString();}
					if ($match[1] == 'rnumber') {$match[1] = generateNumericOTP();}
					$str = str_replace($match[0], $match[1], $str);
				}
			}
		}
		return $str;
	}

}