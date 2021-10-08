<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function index()
	{
		redirect( base_url() );
	}

	public function get_login_otp()
	{
		header('Content-Type: application/json');
		$data['hash'] = $this->security->get_csrf_hash();
		if( count( $this->input->post() ) > 0 ){
			$phone = $this->input->post( 'phone' );
			$user = $this->user->check_phone_exists( $phone );
			if ( $user ) {
				if ($user['user_status'] > 0) {
					$otp = $this->user->gen_user_otp( $user['user_id'] );
					$this->sms->send_template($user['user_phone'], 'my_site_login_otp', ['otpcode' => $otp], 2);
					$this->session->set_userdata('user_phone', $user['user_phone']);
					$data['message'] = lang_item('confirm_otp_sended', [], false);
					$data['status'] = "ok";
					$data['html'] = $this->load->view('components/login_otpform', [],TRUE);	
				}else{
					$data['message'] = lang_item('user_not_activated', [], false);
					$data['status'] = "error";
				}
			}else{
				$data['message'] = lang_item('phone_not_exists', [], false);
				$data['status'] = "error";
			}
		}else{
			$data['message'] = lang_item('phone_not_entered', [], false);
			$data['status'] = "error";
		}

		echo json_encode($data);
		
	}

	public function resend_login_otp()
	{
		header('Content-Type: application/json');
		$data['hash'] = $this->security->get_csrf_hash();
		if ($this->session->has_userdata('user_phone')) {
			$phone = $this->session->userdata('user_phone');
			$user = $this->user->check_phone_exists( $phone );
			if ( $user ) {
				$otp = $this->user->gen_user_otp( $user['user_id'] );
				$this->sms->send_template($user['user_phone'], 'my_site_login_otp', ['otpcode' => $otp], 2);
				$this->session->set_userdata('user_phone', $user['user_phone']);
				$data['message'] = lang_item('confirm_otp_sended', [], false);
				$data['status'] = "ok";
				$data['html'] = $this->load->view('components/login_otpform', [],TRUE);
			}else{
				$data['message'] = lang_item('phone_not_exists', [], false);
				$data['status'] = "error";
			}
		}else{
			$data['message'] = lang_item('phone_not_entered', [], false);
			$data['status'] = "error";
		}
		echo json_encode($data);
	}

	public function check_otp()
	{
		header('Content-Type: application/json');
		$data['hash'] = $this->security->get_csrf_hash();
		if ($this->session->has_userdata('user_phone')) {
			if( count( $this->input->post() ) > 0 ){
				$otp = $this->input->post('otp');
				$phone = $this->session->userdata('user_phone');
				$user = $this->user->check_phone_exists( $phone );
				if ( $user ) {
					if ($user['user_otp'] == $otp) {
						$this->session->set_userdata([
							'user_id' => $user['user_id'],
							'user_avatar' => $user['user_avatar'],
							'user_phone' => $user['user_phone'],
							'user_lastname' => $user['user_lastname'],
							'user_firstname' => $user['user_firstname'],
							'user_middlename' => $user['user_middlename'],
							'user_status' => $user['user_status'],
							'user_type' => $user['user_type'],
							'logged' => TRUE

						]);
						set_cookie('user_type', encode_hash($user['user_type']), $this->config->item('cookie_expire'));
						$this->user->gen_user_otp( $user['user_id'] );
						$data['message'] = lang_item('login_success');
						$data['redirect'] = base_url( 'dashboard' );
						$data['status'] = "ok";
					}else{
						$data['message'] = lang_item('entered_otp_error');
						$data['status'] = "error";
					}
				}else{
					$data['message'] = lang_item('session_expired');
					$data['status'] = "error";
					$data['html'] = $this->load->view('components/login_form', [],TRUE);
				}
			}else{
				$data['message'] = lang_item('fields_not_filled');
				$data['status'] = "error";
			}
		}else{
			$data['message'] = lang_item('session_expired');
			$data['status'] = "error";
			$data['html'] = $this->load->view('components/login_form', [],TRUE);
		}
		echo json_encode($data);
	}
}
