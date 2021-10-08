<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checklogged
{
    function initialize()
    {
        $ci =& get_instance();
        $white_routes = ['login', 'logout', 'ajax', 'general', 'main', 'settings.js', 'gsm'];
        $session = $ci->session->userdata();
        if ($ci->user->checkLogged() == FALSE) {
            if (!in_array($ci->uri->segment(1), $white_routes)) {
                redirect( base_url( 'login' ) );
            }
        }
        if (!in_array($ci->uri->segment(1), $white_routes)) {
            if (get_cookie('user_type') == NULL || get_cookie('user_type') == '') {
                $user_type = 'unknown';
            }else{
                $user_type = decode_hash(get_cookie('user_type'));
            }
            if ($ci->user->checkLogged() == TRUE) {
                if ($ci->session->userdata('user_type') != $user_type) {
                    redirect( base_url( 'logout' ) );
                }
            }
            //$ci->user->redirectUser($user_type);
        }
    }
}
