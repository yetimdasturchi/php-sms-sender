<?php
    $all_smsmessages = number_format($this->db->from('gsmmessages')->count_all_results(), 0, '', ' ');
    $messages_in_progress = number_format($this->db->from('gsmmessages')->where_in('sms_status', ["0", "1"])->count_all_results(), 0, '', ' ');
    $messages_sent = number_format($this->db->where('sms_status', "2")->from('gsmmessages')->count_all_results(), 0, '', ' ');
?>
<div class="row">
    <div class="col-lg-4 col-md-12">
        <div class="card-box widget-box-three">
            <div class="bg-icon pull-left">
                <i class="fi-archive"></i>
            </div>
            <div class="text-right">
                <p class="m-t-5 text-uppercase font-14 font-600"><?php echo lang_item('all_smsmessages');?></p>
                <h2 class="m-b-10"><span class="all-smsmessages-counter"><?php echo $all_smsmessages;?></span></h2>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="card-box widget-box-three">
            <div class="bg-icon pull-left">
                <i class="fi-clock"></i>
            </div>
            <div class="text-right">
                <p class="m-t-5 text-uppercase font-14 font-600"><?php echo lang_item('messages_in_progress');?></p>
                <h2 class="m-b-10"><span class="messages-in-progress-counter"><?php echo $messages_in_progress;?></span></h2>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="card-box widget-box-three">
            <div class="bg-icon pull-left">
                <i class="fi-upload"></i>
            </div>
            <div class="text-right">
                <p class="m-t-5 text-uppercase font-14 font-600"><?php echo lang_item('messages_sent');?></p>
                <h2 class="m-b-10"><span class="messages-sent-counter"><?php echo $messages_sent;?></span></h2>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <?php
                $sendingstatus = setting_item('sendingstatus');
                if ($sendingstatus == 'true') {
                    $sendingstatus_buticon = '<i class="fa fa-pause"></i>';
                    $sendingstatus_butclass = "btn-danger";
                }else{
                    $sendingstatus_buticon = '<i class="fa fa-play"></i>';
                    $sendingstatus_butclass = "btn-warning";
                }
                echo datatableGen('smsrecords', [
                    'class' => 'table table-striped m-0 table-actions-bar dt-responsive nowrapdt-head-right',
                    'id' => 'test',
                    'cellspacing' => '0',
                    'style' => 'width:100%;',
                ], [
                    'processing' => true,
                    'serverSide' => true,
                    'serverMethod' => 'post',
                    'ajax' => [
                        'url' => base_url('sms/getdata/records'),
                        'cache' => false
                    ],
                    'fnRowCallback' => [
                        'arguments' => 'nRow, aData, iDisplayIndex, iDisplayIndexFull',
                        'body' => 'if ( aData[\'sms_status\'] == "0" ){$(nRow).alterClass( \'tr-status-*\', \'tr-status-warning\' );};if ( aData[\'sms_status\'] == "1" ){$(nRow).alterClass( \'tr-status-*\', \'tr-status-success\' );}if ( aData[\'sms_status\'] == "3" ){$(nRow).alterClass( \'tr-status-*\', \'tr-status-danger\' );}if ( aData[\'sms_type\'] == "0" ){$(nRow).alterClass( \'tr-status-*\', \'tr-status-inverse\' );};'
                    ],
                    'columns' => [
                        ['title' => lang_item('hashtag'), 'data' => 'sms_id'],
                        ['title' => lang_item('phone_number'), 'data' => 'sms_phone'],
                        ['title' => lang_item('text'), 'data' => 'sms_message'],
                        ['title' => lang_item('date'), 'data' => 'sms_date'],
                        ['title' => lang_item('send_date'), 'data' => 'sms_senddate'],
                        ['title' => lang_item('received_date'), 'data' => 'sms_received'],
                        ['title' => lang_item('action'), 'data' => 'sms_action']
                    ],
                    'columnDefs' => [
                        ['className' => 'text-center', 'targets' => [0, 3, 4, 5]]
                    ],
                    'order' => [
                        [0, "desc"]
                    ],
                    'responsive' => false,
                    'buttonsDom' => 'Bfrtip',
                    "lengthMenu" => [[10, 25, 50, -1], [lang_item('n_pieces', ['n' => 10]), lang_item('n_pieces', ['n' => 25]), lang_item('n_pieces', ['n' => 50]), lang_item('all')]],
                    'buttons' => [
                        [
                            'text' => '<i class="fa fa-list-ol"></i> '.lang_item('datatable_buttons_pageLength'),
                            'className' => 'btn-inverse',
                            'extend' => 'pageLength'
                        ],
                        [
                            'text' => '<i class="fa fa-list"></i> '.lang_item('columns'),
                            'className' => 'btn-inverse',
                            'extend' => 'colvis'
                        ],
                        [
                            'extend' => 'collection',
                            'text' => '<i class="fa fa-file-text-o"></i> '.lang_item('datatable_export'),
                                'className' => 'btn-inverse',
                            'buttons' => [
                                [
                                    'extend' => 'print',
                                    'text' => '<i class="fa fa-print"></i> '.lang_item('datatable_print'),
                                    'exportOptions' => ['columns' => ':visible'],
                                    'customize' => [
                                        'arguments' => 'win',
                                        'body' => "$(win.document.body).children(\"h1:first\").remove();"
                                    ]
                                ],
                                [
                                    'extend' => 'excel',
                                    'text' => '<i class="fa fa-file-excel-o"></i> '.lang_item('datatable_excel'),
                                    'exportOptions' => ['columns' => ':visible']
                                ],
                                [
                                    'extend' => 'pdf',
                                    'text' => '<i class="fa fa-file-pdf-o"></i> '.lang_item('datatable_pdf'),
                                    'exportOptions' => ['columns' => ':visible'],
                                    'customize' => [
                                        'arguments' => 'doc',
                                        'body' => "doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');"
                                    ]
                                ],
                                [
                                    'extend' => 'copy',
                                    'exportOptions' => ['columns' => ':visible'],
                                    'text' => '<i class="fa fa-copy"></i> '.lang_item('datatable_copy')
                                ]
                            ]
                        ],
                        [
                        'text' => $sendingstatus_buticon,
                            'className' => $sendingstatus_butclass,
                            'action' => ['arguments' => 'e,dt,node,config', 'body' => '$.fn.sendingstatus(node);
                            ']
                        ]
                    ]
                ]);
            ?>
        </div>
    </div>
</div>