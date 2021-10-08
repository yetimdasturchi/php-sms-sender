<?php

Class User_model extends CI_Model {

	public function check_phone_exists($phone='')
	{
		if ($phone != '') {
			$query = $this->db->get_where('users', [
				'user_phone' => clear_phone($phone)
			]);
			if ($query->num_rows() > 0) {
				return $query->row_array();
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}

	public function gen_user_otp($user_id)
	{
		$otp = generateNumericOTP(6);
		$this->db->update('users', ['user_otp' => $otp], array('user_id' => $user_id));
		return $otp;
	}

	public function checkLogged()
	{
		if ($this->session->has_userdata('user_phone') != '' && $this->session->has_userdata('logged') == TRUE) {
    		return TRUE;
    	}else{
    		return FALSE;
    	}
	}

	public function redirectUser( $check )
	{
		if ($check == 'unknown') {
			redirect( base_url( 'logout' ) );
			return;
		}
		if ($this->user->checkLogged() == TRUE) {
			if ($this->session->userdata('user_type') != $check) {
				redirect( base_url( $this->session->userdata('user_type') ) );
			}
    	}else{
    		redirect( base_url( 'login' ) );
    	}
	}

}