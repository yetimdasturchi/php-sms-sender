<?php

Class Superadminsms_model extends CI_Model {

    public function getTableTemplates($postData=null)
    {
		if ($postData == null) {
            return [
                'draw' => 0,
                'iTotalRecords' => 0,
                'iTotalDisplayRecords' => 0,
                'aaData' => [],
            ];
        }

        $response = [];

     	$draw = $postData['draw'];
     	$start = $postData['start'];
     	$rowperpage = $postData['length'];
     	$columnIndex = $postData['order'][0]['column'];
     	$columnName = $postData['columns'][$columnIndex]['data'];
     	$columnSortOrder = $postData['order'][0]['dir'];
     	$searchValue = $postData['search']['value'];

     	$searchQuery = "";
     	if($searchValue != ''){
        	$searchQuery = " (smstemplate_key like '%".$searchValue."%' or smstemplate_text like '%".$searchValue."%' ) ";
     	}

     	$this->db->select('count(*) as allcount');
     	$records = $this->db->get('gsmtemplates')->result();
     	$totalRecords = $records[0]->allcount;

     	$this->db->select('count(*) as allcount');
     	if($searchQuery != '')
        	$this->db->where($searchQuery);
     	$records = $this->db->get('gsmtemplates')->result();
     	$totalRecordwithFilter = $records[0]->allcount;

     	$this->db->select('*');
     	if($searchQuery != '')
        	$this->db->where($searchQuery);
     	$this->db->order_by($columnName, $columnSortOrder);
     	if ($rowperpage != -1) {
            $this->db->limit($rowperpage, $start);
        }
     	$records = $this->db->get('gsmtemplates')->result();

     	$data = [];

     	foreach($records as $record ){
            $delete_button = '';
            if ($record->smstemplate_type != 0) {
                $delete_button = '<button type="button" class="btn btn-icon waves-effect waves-light btn-inverse" delete-template="'.$record->smstemplate_id.'"> <i class="fa fa-trash"></i> </button>';
            }
			$action = '<div class="btn-group"><button type="button" class="btn btn-icon waves-effect waves-light btn-warning" edit-template="'.$record->smstemplate_id.'"> <i class="fa fa-pencil"></i> </button>'.$delete_button.'</div>';
            $data[] = [
           		"smstemplate_id"=>$record->smstemplate_id,
           		"smstemplate_key"=>"<span data-toggle=\"tooltip\" class=\"tooltip-animation pointer\" title=\"".nl2br(wordwrap(htmlentities($record->smstemplate_note), 50, "\n", true))."\">".$record->smstemplate_key."</span>" ,
           		"smstemplate_text"=>$record->smstemplate_text,
           		"smstemplate_status"=> ($record->smstemplate_status == 1) ? '<span class="label label-success">'.lang_item('active').'</span>' : '<span class="label label-inverse">'.lang_item('unactive').'</span>',
                "smstemplate_action"=> $action,
                "smstemplate_type"=> $record->smstemplate_type
        	];
     	}

     	$response = [
        	"draw" => intval($draw),
        	"iTotalRecords" => $totalRecords,
        	"iTotalDisplayRecords" => $totalRecordwithFilter,
        	"aaData" => $data,
     	];

     	$response[$this->security->get_csrf_token_name()] = $this->security->get_csrf_hash();

     	return $response;
	}

    public function getTableGroups($postData=null)
    {
		if ($postData == null) {
            return [
                'draw' => 0,
                'iTotalRecords' => 0,
                'iTotalDisplayRecords' => 0,
                'aaData' => [],
            ];
        }

        $response = [];

     	$draw = $postData['draw'];
     	$start = $postData['start'];
     	$rowperpage = $postData['length'];
     	$columnIndex = $postData['order'][0]['column'];
     	$columnName = $postData['columns'][$columnIndex]['data'];
     	$columnSortOrder = $postData['order'][0]['dir'];
     	$searchValue = $postData['search']['value'];

     	$searchQuery = "";
     	if($searchValue != ''){
        	$searchQuery = " (contactgroup_name like '%".$searchValue."%' or contactgroup_note like '%".$searchValue."%' ) ";
     	}

     	$this->db->select('count(*) as allcount');
     	$records = $this->db->get('gsmcontact_groups')->result();
     	$totalRecords = $records[0]->allcount;

     	$this->db->select('count(*) as allcount');
     	if($searchQuery != '')
        	$this->db->where($searchQuery);
     	$records = $this->db->get('gsmcontact_groups')->result();
     	$totalRecordwithFilter = $records[0]->allcount;

     	$this->db->select('*');
     	if($searchQuery != '')
        	$this->db->where($searchQuery);
     	$this->db->order_by($columnName, $columnSortOrder);
     	if ($rowperpage != -1) {
            $this->db->limit($rowperpage, $start);
        }
     	$records = $this->db->get('gsmcontact_groups')->result();

     	$data = [];

     	foreach($records as $record ){
			$action = '<div class="btn-group"><button type="button" class="btn btn-icon waves-effect waves-light btn-warning" edit-group="'.$record->contactgroup_id.'"> <i class="fa fa-pencil"></i> </button><button type="button" class="btn btn-icon waves-effect waves-light btn-inverse" delete-group="'.$record->contactgroup_id.'"> <i class="fa fa-trash"></i> </button></div>';
            $data[] = [
           		"contactgroup_id"=>$record->contactgroup_id,
           		"contactgroup_name"=>$record->contactgroup_name	,
           		"contactgroup_note"=>$record->contactgroup_note,
           		"contactgroup_action"=> $action
        	];
     	}

     	$response = [
        	"draw" => intval($draw),
        	"iTotalRecords" => $totalRecords,
        	"iTotalDisplayRecords" => $totalRecordwithFilter,
        	"aaData" => $data,
     	];

     	$response[$this->security->get_csrf_token_name()] = $this->security->get_csrf_hash();

     	return $response;
	}

    public function getTableContacts($postData=null)
    {
        if ($postData == null) {
            return [
                'draw' => 0,
                'iTotalRecords' => 0,
                'iTotalDisplayRecords' => 0,
                'aaData' => [],
            ];
        }

        $response = [];
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length'];
        $columnIndex = $postData['order'][0]['column'];
        $columnName = $postData['columns'][$columnIndex]['data'];
        $columnSortOrder = $postData['order'][0]['dir'];
        $searchValue = $postData['search']['value'];

        $searchQuery = "";
        if($searchValue != ''){
            $searchQuery = " (contact_phone like '%".$searchValue."%' or contact_name like '%".$searchValue."%' or contact_note like '%".$searchValue."%' ) ";
        }

        $this->db->select('count(*) as allcount');
        $records = $this->db->get('gsmcontacts')->result();
        $totalRecords = $records[0]->allcount;

        $this->db->select('count(*) as allcount');
        if($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get('gsmcontacts')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        $this->db->select('*');
        if($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        if ($rowperpage != -1) {
            $this->db->limit($rowperpage, $start);
        }
        $records = $this->db->get('gsmcontacts')->result();

        $data = [];

        foreach($records as $record ){
            if ($record->contact_group == 0) {
                $groupname = lang_item('without_group');
            }else{
                $group = $this->db->get_where('gsmcontact_groups', ['contactgroup_id' => $record->contact_group]);
                if ($group->num_rows() > 0) {
                    $groupname = $group->row()->contactgroup_name;
                }else{
                    $groupname = lang_item('unidentified');
                }
            }
            
            $action = '<div class="btn-group"><button type="button" class="btn btn-icon waves-effect waves-light btn-warning" edit-contact="'.$record->contact_id.'"> <i class="fa fa-pencil"></i> </button><button type="button" class="btn btn-icon waves-effect waves-light btn-inverse" delete-contact="'.$record->contact_id.'"> <i class="fa fa-trash"></i> </button></div>';
            $data[] = [
                "contact_id"=>$record->contact_id,
                "contact_phone"=>format_phone($record->contact_phone),
                "contact_name"=>($record->contact_name == '') ? "<span class=\"text-inverse\">".lang_item('unidentified')."</span>" : $record->contact_name,
                "contact_note"=>$record->contact_note,
                "contact_group"=>$groupname,
                "contact_status"=>($record->contact_status == 1) ? '<span class="label label-success">'.lang_item('active').'</span>' : '<span class="label label-inverse">'.lang_item('unactive').'</span>',
                "contact_action"=> $action
            ];
        }

        $response = [
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
        ];

        $response[$this->security->get_csrf_token_name()] = $this->security->get_csrf_hash();

        return $response;
    }

    public function getTableRecords($postData=null)
    {
        if ($postData == null) {
            return [
                'draw' => 0,
                'iTotalRecords' => 0,
                'iTotalDisplayRecords' => 0,
                'aaData' => [],
            ];
        }

        $response = [];
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length'];
        $columnIndex = $postData['order'][0]['column'];
        $columnName = $postData['columns'][$columnIndex]['data'];
        $columnSortOrder = $postData['order'][0]['dir'];
        $searchValue = $postData['search']['value'];

        $searchQuery = "";
        if($searchValue != ''){
            $searchQuery = " (sms_phone like '%".$searchValue."%' or sms_message like '%".$searchValue."%') ";
        }

        $this->db->select('count(*) as allcount');
        $records = $this->db->get('gsmmessages')->result();
        $totalRecords = $records[0]->allcount;

        $this->db->select('count(*) as allcount');
        if($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get('gsmmessages')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        $this->db->select('*');
        if($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        if ($rowperpage != -1) {
            $this->db->limit($rowperpage, $start);
        }
        $records = $this->db->get('gsmmessages')->result();

        $data = [];

        foreach($records as $record ){
            $action = '<div class="btn-group"><button type="button" class="btn btn-icon waves-effect waves-light btn-inverse" resend-sms="'.$record->sms_id.'" title="'.lang_item('sendsms_again').'"> <i class="fa fa-refresh"></i> </button><button type="button" class="btn btn-icon waves-effect waves-light btn-danger" delete-sms="'.$record->sms_id.'" title="'.lang_item('sendsms_again').'"> <i class="fa fa-trash-o"></i> </button></div>';
            $data[] = [
                "sms_id"=>$record->sms_id,
                "sms_phone"=>format_phone($record->sms_phone),
                "sms_message"=>(strlen($record->sms_message) > 20) ? "<span data-toggle=\"tooltip\" class=\"tooltip-animation pointer\" title=\"".nl2br(wordwrap(htmlentities($record->sms_message), 50, "\n", true))."\">".substr($record->sms_message, 0, 20).'...'."</span>" : $record->sms_message,
                "sms_date"=> '<span class="label label-muted">'.date($this->config->item('custom_dateformat_m'), $record->sms_date).'</span>',
                "sms_senddate"=> ($record->sms_senddate > 0) ? '<span class="label label-warning">'.date($this->config->item('custom_dateformat_m'), $record->sms_senddate).'</span>' : "?",
                "sms_received"=> ($record->sms_received > 0) ? '<span class="label label-success">'.date($this->config->item('custom_dateformat_m'), $record->sms_received).'</span>': "?",
                "sms_status"=> $record->sms_status,
                "sms_type"=> $record->sms_type,
                "sms_action"=> $action

            ];
        }

        $response = [
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
        ];

        $response[$this->security->get_csrf_token_name()] = $this->security->get_csrf_hash();

        return $response;
    }

    public function insertTemplate($post=null)
    {
        $data['hash'] = $this->security->get_csrf_hash();
        if ($post == null) {
            $data['status'] = "error";
            $data['message'] = lang_item('fields_not_filled');
            return $data;
        }

        foreach ($post as $key => $value) {
            if ($value == null || $value == '') {
                $data['status'] = "error";
                $data['message'] = lang_item('fields_not_filled');
                return $data;
                break;
            }
        }

        if (strlen($post['text']) > 160) {
            $data['status'] = "error";
            $data['message'] = lang_item('smstext_max_chars', ['count' => $this->config->item('max_sms_chars')]);
            return $data;
        }

        $this->db->insert('gsmtemplates', [
            'smstemplate_key' => $post['key'],
            'smstemplate_text' => $post['text'],
            'smstemplate_status' => $post['status'],
            'smstemplate_type' => 1,
        ]);

        $data['status'] = "ok";
        $data['message'] = lang_item('information_inserted_success');
        return $data;


    }

    public function insertGroup($post=null)
    {
        $data['hash'] = $this->security->get_csrf_hash();
        if ($post == null) {
            $data['status'] = "error";
            $data['message'] = lang_item('fields_not_filled');
            return $data;
        }

        if (strlen($post['name']) == 0) {
            $data['status'] = "error";
            $data['message'] = lang_item('fields_not_filled');
            return $data;
        }

        $this->db->insert('gsmcontact_groups', [
            'contactgroup_name' => $post['name'],
            'contactgroup_note' => $post['note'],
        ]);

        $data['status'] = "ok";
        $data['message'] = lang_item('information_inserted_success');
        return $data;
    }

    public function deleteTemplate($id='')
    {
        $data['hash'] = $this->security->get_csrf_hash();
        if ($id == '') {
            $data['status'] = "error";
            $data['message'] = lang_item('delete_no_id');
            return $data;
        }

        $this->db->delete('gsmtemplates', ['smstemplate_id' => $id]);
        $data['status'] = "ok";
        $data['message'] = lang_item('information_deleted_success');
        return $data;
    }

    public function deleteGroup($id='')
    {
        $data['hash'] = $this->security->get_csrf_hash();
        if ($id == '') {
            $data['status'] = "error";
            $data['message'] = lang_item('delete_no_id');
            return $data;
        }

        $this->db->delete('gsmcontact_groups', ['contactgroup_id' => $id]);
        $this->db->delete('gsmcontacts', ['contact_group' => $id]);
        $data['status'] = "ok";
        $data['message'] = lang_item('information_deleted_success');
        return $data;
    }

    public function deleteSms($id='')
    {
        $data['hash'] = $this->security->get_csrf_hash();
        if ($id == '') {
            $data['status'] = "error";
            $data['message'] = lang_item('delete_no_id');
            return $data;
        }

        $this->db->update('gsmmessages', ['sms_status' => 3], ['sms_id' => $id]);
        $data['status'] = "ok";
        $data['message'] = lang_item('information_deleted_success');
        return $data;
    }

    public function getSingleTemplate($id='')
    {
        $data['hash'] = $this->security->get_csrf_hash();

        $query = $this->db->get_where('gsmtemplates', ['smstemplate_id' => $id]);
        if ($query->num_rows() > 0) {
            $query = $query->row();
            $data['content'] = [
                'key' => $query->smstemplate_key,
                'text' => $query->smstemplate_text,
                'status' => $query->smstemplate_status,
                'type' => $query->smstemplate_type
            ];
            $data['status'] = "ok";
            $data['message'] = lang_item('data_founded_with_this_id');
            return $data;
        }else{
            $data['status'] = "error";
            $data['message'] = lang_item('no_data_with_this_id');
            return $data;
        }
    }

    public function getSingleGroup($id='')
    {
        $data['hash'] = $this->security->get_csrf_hash();

        $query = $this->db->get_where('gsmcontact_groups', ['contactgroup_id' => $id]);
        if ($query->num_rows() > 0) {
            $query = $query->row();
            $data['content'] = [
                'name' => $query->contactgroup_name,
                'note' => $query->contactgroup_note
            ];
            $data['status'] = "ok";
            $data['message'] = lang_item('data_founded_with_this_id');
            return $data;
        }else{
            $data['status'] = "error";
            $data['message'] = lang_item('no_data_with_this_id');
            return $data;
        }
    }

    public function getSingleContact($id='')
    {
        $data['hash'] = $this->security->get_csrf_hash();

        $query = $this->db->get_where('gsmcontacts', ['contact_id' => $id]);
        if ($query->num_rows() > 0) {
            $query = $query->row();
            $data['content'] = [
                'phone' => $query->contact_phone,
                'name' => $query->contact_name,
                'group' => $query->contact_group,
                'status' => $query->contact_status,
                'note' => $query->contact_note,
            ];
            $data['status'] = "ok";
            $data['message'] = lang_item('data_founded_with_this_id');
            return $data;
        }else{
            $data['status'] = "error";
            $data['message'] = lang_item('no_data_with_this_id');
            return $data;
        }
    }

    public function updateTemplate($post=null)
    {
        $data['hash'] = $this->security->get_csrf_hash();
        if ($post == null) {
            $data['status'] = "error";
            $data['message'] = lang_item('fields_not_filled');
            return $data;
        }

        foreach ($post as $key => $value) {
            if ($value == null || $value == '') {
                $data['status'] = "error";
                $data['message'] = lang_item('fields_not_filled');
                return $data;
                break;
            }
        }

        $query = $this->db->get_where('gsmtemplates', ['smstemplate_id' => $post['id']]);
        if ($query->num_rows() > 0) {
            $query = $query->row();
            $this->db->update('gsmtemplates', [
                'smstemplate_key' => $post['key'],
                'smstemplate_text' => $post['text'],
                'smstemplate_status' => $post['status']
            ], ['smstemplate_id' => $post['id']]);
            $data['status'] = "ok";
            $data['message'] = lang_item('information_updated_success');
            return $data;
        }else{
            $data['status'] = "error";
            $data['message'] = lang_item('no_data_with_this_id');
            return $data;
        }

    }

    public function updateGroup($post=null)
    {
        $data['hash'] = $this->security->get_csrf_hash();
        if ($post == null) {
            $data['status'] = "error";
            $data['message'] = lang_item('fields_not_filled');
            return $data;
        }

        if (strlen($post['name']) == 0) {
            $data['status'] = "error";
            $data['message'] = lang_item('fields_not_filled');
            return $data;
        }

        $query = $this->db->get_where('gsmcontact_groups', ['contactgroup_id' => $post['id']]);
        if ($query->num_rows() > 0) {
            $query = $query->row();
            $this->db->update('gsmcontact_groups', [
                'contactgroup_name' => $post['name'],
                'contactgroup_note' => $post['note']
            ], ['contactgroup_id' => $post['id']]);
            $data['status'] = "ok";
            $data['message'] = lang_item('information_updated_success');
            return $data;
        }else{
            $data['status'] = "error";
            $data['message'] = lang_item('no_data_with_this_id');
            return $data;
        }
    }

    public function insertContact($post=null)
    {
        $data['hash'] = $this->security->get_csrf_hash();
        if ($post == null) {
            $data['status'] = "error";
            $data['message'] = lang_item('fields_not_filled');
            return $data;
        }

        $post['phone'] = clear_phone($post['phone']);

        if (!validate_phone($post['phone'])) {
            $data['status'] = "error";
            $data['message'] = lang_item('phone_invalid_format');
            return $data;
        }

        $this->db->insert('gsmcontacts', [
            'contact_phone' => $post['phone'],
            'contact_name' => $post['name'],
            'contact_note' => $post['note'],
            'contact_group' => $post['group'],
            'contact_status' => $post['status']
        ]);

        $data['status'] = "ok";
        $data['message'] = lang_item('information_inserted_success');
        return $data;
    }

    public function importContact($post=null, $file=null)
    {
        $data['hash'] = $this->security->get_csrf_hash();
        if ($post == null) {
            $data['status'] = "error";
            $data['message'] = lang_item('fields_not_filled');
            return $data;
        }

        if ($file == null || !isset($file['file'])) {
            $data['status'] = "error";
            $data['message'] = lang_item('file_not_selected');
            return $data;
        }

        $ext = getFileExt($file['file']['name']);

        if (in_array($ext, ['xlsx', 'vcf', 'json'])) {
            $newfilename = './uploads/tmp/'.time().'.'.$ext;
            if (move_uploaded_file($file['file']['tmp_name'], $newfilename)) {
                if ($ext == 'xlsx') {
                    $this->load->library('SimpleXLSX');
                    $xlsx = new SimpleXLSX($newfilename);
                    if ( $xlsx->success() ) {
                        if (count($xlsx->rows())) {
                            foreach ($xlsx->rows() as $row) {
                                $insertSingleData = [];
                                if (array_key_exists(0, $row)) {
                                    $row[0] = clear_phone($row[0]);
                                    if (validate_phone($row[0])) {
                                        $insertSingleData['contact_phone'] = $row[0];
                                        if (array_key_exists(1, $row)) {
                                            $insertSingleData['contact_name'] = $row[1];
                                        }
                                        $insertSingleData['contact_note'] = $post['note'];
                                        $insertSingleData['contact_group'] = $post['group'];
                                        $insertSingleData['contact_status'] = $post['status'];
                                        $dublicate = $this->db->get_where('gsmcontacts', ['contact_phone' => $row[0]]);
                                        if ($dublicate->num_rows() == 0) {
                                            $this->db->insert('gsmcontacts', $insertSingleData);
                                        }
                                    }
                                }
                            }
                            $data['status'] = "ok";
                            $data['message'] = lang_item('information_inserted_success');
                            return $data;
                        }else{
                            $data['status'] = "error";
                            $data['message'] = lang_item('eror_while_reading_file');
                            return $data;
                        }
                    }else {
                        $data['status'] = "error";
                        $data['message'] = lang_item('eror_while_reading_file');
                        return $data;
                    }
                }
                if ($ext == 'vcf') {
                    $this->load->library('Vcard');
                    $vCard = new vCard($newfilename, true, array('Collapse' => true));
                    if (count($vCard) > 1) {
                        foreach ($vCard as $row) {
                            $insertSingleData = [];
                            $phone = $row->tel;
                            $fullname = $row->fn;
                            if (array_key_exists(0, $phone)) {
                                $cphone = clear_phone($phone[0]['Value']);
                                if (validate_phone($cphone)) {
                                    $insertSingleData['contact_phone'] = $cphone;
                                    if (array_key_exists(0, $fullname)) {
                                        $insertSingleData['contact_name'] = $fullname[0];
                                    }
                                    $insertSingleData['contact_note'] = $post['note'];
                                    $insertSingleData['contact_group'] = $post['group'];
                                    $insertSingleData['contact_status'] = $post['status'];
                                    $dublicate = $this->db->get_where('gsmcontacts', ['contact_phone' => $cphone]);
                                    if ($dublicate->num_rows() == 0) {
                                        $this->db->insert('gsmcontacts', $insertSingleData);
                                    }
                                }
                            }
                        }
                        $data['status'] = "ok";
                        $data['message'] = lang_item('information_inserted_success');
                        return $data;
                    }else{
                        $data['status'] = "error";
                        $data['message'] = lang_item('eror_while_reading_file');
                        return $data;
                    }
                }
            	if ($ext == 'json') {
                    $json = file_get_contents($newfilename);
                    $json = json_decode($json, TRUE);
                    if (is_array($json) && count($json) > 0) {
                        foreach ($json as $row) {
                            $insertSingleData = [];
                            if (array_key_exists('phone', $row)) {
                                $row['phone'] = clear_phone($row['phone']);
                                if (validate_phone($row['phone'])) {
                                    $insertSingleData['contact_phone'] = $row['phone'];
                                    if (array_key_exists('name', $row)) {
                                        $insertSingleData['contact_name'] = $row['name'];
                                    }
                                    $insertSingleData['contact_note'] = $post['note'];
                                    $insertSingleData['contact_group'] = $post['group'];
                                    $insertSingleData['contact_status'] = $post['status'];
                                    $dublicate = $this->db->get_where('gsmcontacts', ['contact_phone' => $row['phone']]);
                                    if ($dublicate->num_rows() == 0) {
                                        $this->db->insert('gsmcontacts', $insertSingleData);
                                    }
                                }
                            }
                        }
                        $data['status'] = "ok";
                        $data['message'] = lang_item('information_inserted_success');
                        return $data;
                    }else{
                        $data['status'] = "error";
                        $data['message'] = lang_item('eror_while_reading_file');
                        return $data;
                    }
                }
            }else{
                $data['status'] = "error";
                $data['message'] = lang_item('eror_while_uploading_file');
                return $data;
            }
        }else{
            $data['status'] = "error";
            $data['message'] = lang_item('invalid_file_ext');
            return $data;
        }

        $data['status'] = "error";
        $data['message'] = lang_item('eror_while_uploading_file');
        return $data;
    }

    public function updateContact($post=null)
    {
        $data['hash'] = $this->security->get_csrf_hash();
        if ($post == null) {
            $data['status'] = "error";
            $data['message'] = lang_item('fields_not_filled');
            return $data;
        }

        $post['phone'] = clear_phone($post['phone']);

        if (!validate_phone($post['phone'])) {
            $data['status'] = "error";
            $data['message'] = lang_item('phone_invalid_format');
            return $data;
        }

        $query = $this->db->get_where('gsmcontacts', ['contact_id' => $post['id']]);
        if ($query->num_rows() > 0) {
            $query = $query->row();
            $this->db->update('gsmcontacts', [
                'contact_phone' => $post['phone'],
                'contact_name' => $post['name'],
                'contact_note' => $post['note'],
                'contact_group' => $post['group'],
                'contact_status' => $post['status']
            ], ['contact_id' => $post['id']]);
            $data['status'] = "ok";
            $data['message'] = lang_item('information_updated_success');
            return $data;
        }else{
            $data['status'] = "error";
            $data['message'] = lang_item('no_data_with_this_id');
            return $data;
        }
    }

    public function deleteContact($id='')
    {
        $data['hash'] = $this->security->get_csrf_hash();
        if ($id == '') {
            $data['status'] = "error";
            $data['message'] = lang_item('delete_no_id');
            return $data;
        }

        $this->db->delete('gsmcontacts', ['contact_id' => $id]);
        $data['status'] = "ok";
        $data['message'] = lang_item('information_deleted_success');
        return $data;
    }

    public function getRecordsCounter()
    {
        $data['hash'] = $this->security->get_csrf_hash();
        $all_smsmessages = number_format($this->db->from('gsmmessages')->count_all_results(), 0, '', ' ');
        $messages_in_progress = number_format($this->db->from('gsmmessages')->where_in('sms_status', ["0", "1"])->count_all_results(), 0, '', ' ');
        $messages_sent = number_format($this->db->where('sms_status', "2")->from('gsmmessages')->count_all_results(), 0, '', ' ');

        $data['status'] = "ok";
        $data['message'] = lang_item('data_founded_with_this_id');
        $data['content'] = [
            'all_smsmessages' => $all_smsmessages,
            'messages_in_progress' => $messages_in_progress,
            'messages_sent' => $messages_sent
        ];
        return $data;
    }

    public function getSearchNumber($postData=null)
    {
        $data['hash'] = $this->security->get_csrf_hash();
        $this->db->select('contact_phone, contact_name');
        $this->db->where('contact_status', "1");
        if (strlen(clear_phone($postData)) > 3) {
            $this->db->like('contact_phone', clear_phone($postData));
            $this->db->or_like('contact_name', $postData);
        }else{
            $this->db->like('contact_name', $postData);
        }
        $query = $this->db->get('gsmcontacts');
        if ($query->num_rows() > 0) {
            $data['status'] = "ok";
            $data['content'] = [
                'id' => $query->row()->contact_phone,
                'text' => $query->row()->contact_name,
            ];
        }else{
            $data['content'] = null;
            $data['status'] = "error";
        }
        return $data;
    }

    public function sendMessage($postData=null)
    {
        $data['hash'] = $this->security->get_csrf_hash();
        if ($postData == null) {
            $data['status'] = "error";
            $data['message'] = lang_item('fields_not_filled');
            return $data;
        }
        if (strlen($postData['sendtext']) == 0) {
            $data['status'] = "error";
            $data['message'] = lang_item('fields_not_filled');
            return $data;
        }
        if (strlen($postData['sendtext']) > 160) {
            $data['status'] = "error";
            $data['message'] = lang_item('smstext_max_chars', ['count' => $this->config->item('max_sms_chars')]);
            return $data;
        }
        if (array_key_exists('sendimportance', $postData)) {
            $sendimportance = $postData['sendimportance'];
        }else{
            $sendimportance = 0;
        }
        
        if (array_key_exists('senddate', $postData)) {
            $senddate = $postData['senddate'];
        }else{
            $senddate = date("m/d/Y");
        }

        if (array_key_exists('sendtime', $postData)) {
            $sendtime = $postData['sendtime'];
        }else{
            $sendtime = date("H:i");
        }

        $send_date = $senddate.' '.$sendtime;

        if (!array_key_exists('group', $postData)) {
            $contacts = $this->db->get_where('gsmcontacts', ['contact_status' => '1']);
            if ($contacts->num_rows() > 0) {
                foreach ($contacts->result_array() as $contact) {
                    $numbers[] = $contact['contact_phone'];
                }
            }
        }else{
            $numbers = [];
            foreach ($postData['group'] as $groupitem) {
                $phone = clear_phone($groupitem);           
                if (validate_phone($phone)) {
                    $numbers[] = $phone;
                }

                if (strpos($groupitem, 'group_') !== false) {
                    $groupid = str_replace('group_', '', $groupitem);
                    $contacts = $this->db->get_where('gsmcontacts', ['contact_group' => $groupid, 'contact_status' => '1']);
                    if ($contacts->num_rows() > 0) {
                        foreach ($contacts->result_array() as $contact) {
                            $numbers[] = $contact['contact_phone'];
                        }
                    }
                }
            }
        }
        
        $numbers = array_unique($numbers);
        $insertData = [];
        foreach ($numbers as $number) {
            $insertSingleData = [
                'sms_phone' => $number,
                'sms_message' => $this->sms->benchmark($postData['sendtext']),
                'sms_status' => 0,
                'sms_type' => 1,
                'sms_importance' => $sendimportance,
                'sms_date' => strtotime($send_date),
                'sms_senddate' => 0,
                'sms_received' => 0,
            ];
            $insertData[] = $insertSingleData;
        }
        $this->db->insert_batch('gsmmessages', $insertData); 

        $data['status'] = "ok";
        $data['message'] = lang_item('information_inserted_success');
        $data['redirect'] = base_url('sms/records');
        return $data;
    }

    public function sendingStatus()
    {
        $data['hash'] = $this->security->get_csrf_hash();
        if (setting_item('sendingstatus') == 'false') {
            $status = 'true';
            $data['message'] = lang_item('sendingstatus_true');
        }else{
            $status = 'false';
            $data['message'] = lang_item('sendingstatus_false');
        }
        setting_item('sendingstatus', $status);

        $data['status'] = "ok";
        
        $data['content'] = [
            'status' => $status
        ];
        return $data;
    }

    public function resendSms($id='')
    {
        $data['hash'] = $this->security->get_csrf_hash();
        if ($id == '') {
            $data['status'] = "error";
            $data['message'] = lang_item('no_data_with_this_id');
            return $data;
        }
        $sms = $this->db->get_where('gsmmessages', ['sms_id' => $id]);
        if ($sms->num_rows() > 0) {
            $sms = $sms->row_array();
            $this->db->insert('gsmmessages', [
                'sms_phone' => $sms['sms_phone'],
                'sms_message' => $sms['sms_message'],
                'sms_status' => 0,
                'sms_type' => $sms['sms_type'],
                'sms_importance' => $sms['sms_importance'],
                'sms_date' => time(),
                'sms_senddate' => 0,
                'sms_received' => 0,
            ]);
            $data['status'] = "ok";
            $data['message'] = lang_item('information_inserted_success');
            return $data;
        }else{
            $data['status'] = "error";
            $data['message'] = lang_item('no_data_with_this_id');
            return $data;
        }
    }

}
