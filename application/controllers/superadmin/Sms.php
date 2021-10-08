<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('superadmin/superadmin_model', 'superadmin');
        $this->load->model('superadmin/Superadminsms_model');
        $this->config->load('gsm_config');
    }

    public function index()
    {
		$this->records();
	}

    public function records()
    {
        $this->superadmin->showView('sms/records', [
            'meta_title' => lang_item('sms_messages') .' - '. lang_item('sms_messages_list'),
            'section_title' => lang_item('sms_messages_list'),
            'section_breadcrumb' => [
                ['url' => user_base_url('sms/list'),'text' => lang_item('sms_messages')],
                ['text' => lang_item('sms_messages_list')],
            ],
            'css' => [
                'before' => [
                    base_url('assets/plugins/datatables/dataTables.bootstrap4.min.css'),
                    base_url('assets/plugins/datatables/buttons.bootstrap4.min.css'),
                    base_url('assets/plugins/datatables/responsive.bootstrap4.min.css'),
                    base_url('assets/plugins/tooltipster/tooltipster.bundle.min.css'),
                    base_url('assets/plugins/sweet-alert2/sweetalert2.min.css')
                ]
            ],
            'js' => [
                'before' => [
                    base_url('assets/plugins/datatables/jquery.dataTables.min.js'),
                    base_url('assets/plugins/datatables/dataTables.bootstrap4.min.js'),
                    base_url('assets/plugins/datatables/dataTables.buttons.min.js'),
                    base_url('assets/plugins/datatables/buttons.bootstrap4.min.js'),
                    base_url('assets/plugins/datatables/jszip.min.js'),
                    base_url('assets/plugins/datatables/pdfmake.min.js'),
                    base_url('assets/plugins/datatables/vfs_fonts.js'),
                    base_url('assets/plugins/datatables/buttons.html5.min.js'),
                    base_url('assets/plugins/datatables/buttons.print.min.js'),
                    base_url('assets/plugins/datatables/buttons.colVis.min.js'),
                    base_url('assets/plugins/datatables/dataTables.responsive.min.js'),
                    base_url('assets/plugins/datatables/responsive.bootstrap4.min.js'),
                    base_url('assets/plugins/tooltipster/tooltipster.bundle.min.js'),
                    base_url('assets/plugins/sweet-alert2/sweetalert2.min.js')
                ],
                'after' => [
                    base_url('assets/pages/superadmin/smsrecords.js')
                ]
            ]
        ]);
    }

    public function send()
    {
        $this->superadmin->showView('sms/send', [
            'meta_title' => lang_item('sms_messages') .' - '. lang_item('sms_messages_send'),
            'section_title' => lang_item('sms_messages_send'),
            'section_breadcrumb' => [
                ['url' => user_base_url('sms/list'),'text' => lang_item('sms_messages')],
                ['text' => lang_item('sms_messages_send')],
            ],
            'css' => [
                'before' => [
                    base_url('assets/plugins/bootstrap-select/css/bootstrap-select.min.css'),
                    base_url('assets/plugins/select2/css/select2.min.css'),
                    base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css"'),
                    base_url('assets/plugins/timepicker/bootstrap-timepicker.min.css')
                ]
            ],
            'js' => [
                'before' => [
                    base_url('assets/plugins/select2/js/select2.min.js'),
                    base_url('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js'),
                    base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'),
                    base_url('assets/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.'.$this->config->item('language').'.js'),
                    base_url('assets/plugins/timepicker/bootstrap-timepicker.js')
                ],
                'after' => [
                    base_url('assets/pages/superadmin/smssend.js')
                ]
            ]
        ]);
    }

    public function contacts()
    {
        $this->superadmin->showView('sms/contacts', [
            'meta_title' => lang_item('sms_messages') .' - '. lang_item('sms_messages_contacts'),
            'section_title' => lang_item('sms_messages_contacts'),
            'section_breadcrumb' => [
                ['url' => user_base_url('sms/list'),'text' => lang_item('sms_messages')],
                ['text' => lang_item('sms_messages_contacts')],
            ],
            'css' => [
                'before' => [
                    base_url('assets/plugins/datatables/dataTables.bootstrap4.min.css'),
                    base_url('assets/plugins/datatables/buttons.bootstrap4.min.css'),
                    base_url('assets/plugins/datatables/responsive.bootstrap4.min.css'),
                    base_url('assets/plugins/sweet-alert2/sweetalert2.min.css')
                ]
            ],
            'js' => [
                'before' => [
                    base_url('assets/plugins/datatables/jquery.dataTables.min.js'),
                    base_url('assets/plugins/datatables/dataTables.bootstrap4.min.js'),
                    base_url('assets/plugins/datatables/dataTables.buttons.min.js'),
                    base_url('assets/plugins/datatables/buttons.bootstrap4.min.js'),
                    base_url('assets/plugins/datatables/jszip.min.js'),
                    base_url('assets/plugins/datatables/pdfmake.min.js'),
                    base_url('assets/plugins/datatables/vfs_fonts.js'),
                    base_url('assets/plugins/datatables/buttons.html5.min.js'),
                    base_url('assets/plugins/datatables/buttons.print.min.js'),
                    base_url('assets/plugins/datatables/buttons.colVis.min.js'),
                    base_url('assets/plugins/datatables/dataTables.responsive.min.js'),
                    base_url('assets/plugins/datatables/responsive.bootstrap4.min.js'),
                    base_url('assets/plugins/sweet-alert2/sweetalert2.min.js'),
                    base_url('assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')
                ],
                'after' => [
                    base_url('assets/pages/superadmin/smscontacts.js')
                ]
            ]
        ]);
    }

    public function groups()
    {
        $this->superadmin->showView('sms/groups', [
            'meta_title' => lang_item('sms_messages') .' - '. lang_item('sms_messages_groups'),
            'section_title' => lang_item('sms_messages_groups'),
            'section_breadcrumb' => [
                ['url' => user_base_url('sms/list'),'text' => lang_item('sms_messages')],
                ['text' => lang_item('sms_messages_groups')],
            ],
            'css' => [
                'before' => [
                    base_url('assets/plugins/datatables/dataTables.bootstrap4.min.css'),
                    base_url('assets/plugins/datatables/buttons.bootstrap4.min.css'),
                    base_url('assets/plugins/datatables/responsive.bootstrap4.min.css'),
                    base_url('assets/plugins/sweet-alert2/sweetalert2.min.css')
                ]
            ],
            'js' => [
                'before' => [
                    base_url('assets/plugins/datatables/jquery.dataTables.min.js'),
                    base_url('assets/plugins/datatables/dataTables.bootstrap4.min.js'),
                    base_url('assets/plugins/datatables/dataTables.buttons.min.js'),
                    base_url('assets/plugins/datatables/buttons.bootstrap4.min.js'),
                    base_url('assets/plugins/datatables/jszip.min.js'),
                    base_url('assets/plugins/datatables/pdfmake.min.js'),
                    base_url('assets/plugins/datatables/vfs_fonts.js'),
                    base_url('assets/plugins/datatables/buttons.html5.min.js'),
                    base_url('assets/plugins/datatables/buttons.print.min.js'),
                    base_url('assets/plugins/datatables/buttons.colVis.min.js'),
                    base_url('assets/plugins/datatables/dataTables.responsive.min.js'),
                    base_url('assets/plugins/datatables/responsive.bootstrap4.min.js'),
                    base_url('assets/plugins/sweet-alert2/sweetalert2.min.js')
                ],
                'after' => [
                    base_url('assets/pages/superadmin/smsgroup.js')
                ]
            ]
        ]);
    }

    public function templates()
    {
        $this->superadmin->showView('sms/templates', [
            'meta_title' => lang_item('sms_messages') .' - '. lang_item('sms_messages_templates'),
            'section_title' => lang_item('sms_messages_templates'),
            'section_breadcrumb' => [
                ['url' => user_base_url('sms/list'),'text' => lang_item('sms_messages')],
                ['text' => lang_item('sms_messages_templates')],
            ],
            'css' => [
                'before' => [
                    base_url('assets/plugins/datatables/dataTables.bootstrap4.min.css'),
                    base_url('assets/plugins/datatables/buttons.bootstrap4.min.css'),
                    base_url('assets/plugins/datatables/responsive.bootstrap4.min.css'),
                    base_url('assets/plugins/sweet-alert2/sweetalert2.min.css'),
                    base_url('assets/plugins/tooltipster/tooltipster.bundle.min.css')
                ]
            ],
            'js' => [
                'before' => [
                    base_url('assets/plugins/datatables/jquery.dataTables.min.js'),
                    base_url('assets/plugins/datatables/dataTables.bootstrap4.min.js'),
                    base_url('assets/plugins/datatables/dataTables.buttons.min.js'),
                    base_url('assets/plugins/datatables/buttons.bootstrap4.min.js'),
                    base_url('assets/plugins/datatables/jszip.min.js'),
                    base_url('assets/plugins/datatables/pdfmake.min.js'),
                    base_url('assets/plugins/datatables/vfs_fonts.js'),
                    base_url('assets/plugins/datatables/buttons.html5.min.js'),
                    base_url('assets/plugins/datatables/buttons.print.min.js'),
                    base_url('assets/plugins/datatables/buttons.colVis.min.js'),
                    base_url('assets/plugins/datatables/dataTables.responsive.min.js'),
                    base_url('assets/plugins/datatables/responsive.bootstrap4.min.js'),
                    base_url('assets/plugins/sweet-alert2/sweetalert2.min.js'),
                    base_url('assets/plugins/tooltipster/tooltipster.bundle.min.js'),
                ],
                'after' => [
                    base_url('assets/pages/superadmin/smstemplates.js')
                ]
            ]
        ]);
    }

    public function getdata($action='')
    {
        if ($action == 'templates') {
            $postData = $this->input->post();
            $data = $this->Superadminsms_model->getTableTemplates($postData);
            echo json_encode($data);
        }
        if ($action == 'groups') {
            $postData = $this->input->post();
            $data = $this->Superadminsms_model->getTableGroups($postData);
            echo json_encode($data);
        }
        if ($action == 'contacts') {
            $postData = $this->input->post();
            $data = $this->Superadminsms_model->getTableContacts($postData);
            echo json_encode($data);
        }
        if ($action == 'records') {
            $postData = $this->input->post();
            $data = $this->Superadminsms_model->getTableRecords($postData);
            echo json_encode($data);
        }
        if ($action == 'single_template') {
            header('Content-Type: application/json');
            $postData = $this->input->post('id');
            $data = $this->Superadminsms_model->getSingleTemplate($postData);
            echo json_encode($data);
        }
        if ($action == 'single_group') {
            header('Content-Type: application/json');
            $postData = $this->input->post('id');
            $data = $this->Superadminsms_model->getSingleGroup($postData);
            echo json_encode($data);
        }
        if ($action == 'single_contact') {
            header('Content-Type: application/json');
            $postData = $this->input->post('id');
            $data = $this->Superadminsms_model->getSingleContact($postData);
            echo json_encode($data);
        }
        if ($action == 'recordscounter') {
            header('Content-Type: application/json');
            $data = $this->Superadminsms_model->getRecordsCounter();
            echo json_encode($data);
        }

        if ($action == 'search_number') {
            header('Content-Type: application/json');
            $postData = $this->input->post('q');
            $data = $this->Superadminsms_model->getSearchNumber($postData);
            echo json_encode($data);
        }
    }

    public function insertdata($action='')
    {
        if ($action == 'template') {
            header('Content-Type: application/json');
            $postData = $this->input->post();
            $data = $this->Superadminsms_model->insertTemplate($postData);
            echo json_encode($data);
        }

        if ($action == 'group') {
            header('Content-Type: application/json');
            $postData = $this->input->post();
            $data = $this->Superadminsms_model->insertGroup($postData);
            echo json_encode($data);
        }

        if ($action == 'contact') {
            header('Content-Type: application/json');
            $postData = $this->input->post();
            $data = $this->Superadminsms_model->insertContact($postData);
            echo json_encode($data);
        }
        if ($action == 'importcontact') {
            header('Content-Type: application/json');
            $postData = $this->input->post();
            $data = $this->Superadminsms_model->importContact($postData, $_FILES);
            echo json_encode($data);
        }
        if ($action == 'sendmessage') {
            header('Content-Type: application/json');
            $postData = $this->input->post();
            $data = $this->Superadminsms_model->sendMessage($postData);
            echo json_encode($data);
        }
    }

    public function deletedata($action='')
    {
        if ($action == 'template') {
            header('Content-Type: application/json');
            $id = $this->input->post('id');
            $data = $this->Superadminsms_model->deleteTemplate($id);
            echo json_encode($data);
        }

        if ($action == 'group') {
            header('Content-Type: application/json');
            $id = $this->input->post('id');
            $data = $this->Superadminsms_model->deleteGroup($id);
            echo json_encode($data);
        }

        if ($action == 'contact') {
            header('Content-Type: application/json');
            $id = $this->input->post('id');
            $data = $this->Superadminsms_model->deleteContact($id);
            echo json_encode($data);
        }

        if ($action == 'sms') {
            header('Content-Type: application/json');
            $id = $this->input->post('id');
            $data = $this->Superadminsms_model->deleteSms($id);
            echo json_encode($data);
        }
    }

    public function updatedata($action='')
    {
        if ($action == 'template') {
            header('Content-Type: application/json');
            $postDat = $this->input->post();
            $data = $this->Superadminsms_model->updateTemplate($postDat);
            echo json_encode($data);
        }
        if ($action == 'group') {
            header('Content-Type: application/json');
            $postDat = $this->input->post();
            $data = $this->Superadminsms_model->updateGroup($postDat);
            echo json_encode($data);
        }
        if ($action == 'contact') {
            header('Content-Type: application/json');
            $postDat = $this->input->post();
            $data = $this->Superadminsms_model->updateContact($postDat);
            echo json_encode($data);
        }
        if ($action == 'sendingstatus') {
            header('Content-Type: application/json');
            $postDat = $this->input->post();
            $data = $this->Superadminsms_model->sendingStatus();
            echo json_encode($data);
        }
        if ($action == 'resendsms') {
            header('Content-Type: application/json');
            $id = $this->input->post('id');
            $data = $this->Superadminsms_model->resendSms($id);
            echo json_encode($data);
        }
    }
}
