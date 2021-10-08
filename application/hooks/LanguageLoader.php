<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LanguageLoader
{
    function initialize()
    {
        $ci = & get_instance();
        $ci->load->helper('language');
        $siteLang = get_cookie('language');
        if ($siteLang) {
            $ci->lang->load('content', $siteLang);
            $ci->config->set_item('language', $siteLang);
        } else {
            $ci->lang->load('content', $ci->config->item('language'));
        }
    }
}