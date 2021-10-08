<?php

Class Superadmin_model extends CI_Model {

    public function showView($section='', $set=[])
    {
        $data['meta_title'] = lang_item('sitetitle');
        $data['meta_og_image'] = base_url('assets/images/opengraph.png');
        $data['meta_description'] = lang_item('meta_content');
        $data['css'] = [];
        $data['js'] = [];
        $data['section'] = 'superadmin/'.$section;
        $data['section_data'] = [];
        $data['section_title'] = "";
        $data['section_breadcrumb'] = [];

        if (count($set) > 0) {
            foreach ($set as $key => $value) {
                $data[$key] = $value;                
            }
        }

        if ($section != '') {
            $this->load->view('superadmin/index', ['data' => $data]);
        }else{
            $this->load->view('main/error');
        }
    }
}