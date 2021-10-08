<div class="row">
    <div class="col-12">
        <div class="card-box">
            <?php
                echo datatableGen('smscontacts', [
                    'class' => 'table table-striped m-0 table-actions-bar dt-responsive nowrapdt-head-right',
                    'id' => 'test',
                    'cellspacing' => '0',
                    'style' => 'width:100%;',
                ], [
                    'processing' => true,
                    'serverSide' => true,
                    'serverMethod' => 'post',
                    'ajax' => [
                        'url' => base_url('sms/getdata/contacts'),
                        'cache' => false
                    ],
                    'columns' => [
                        ['title' => lang_item('hashtag'), 'data' => 'contact_id'],
                        ['title' => lang_item('phone_number'), 'data' => 'contact_phone'],
                        ['title' => lang_item('name'), 'data' => 'contact_name'],
                        ['title' => lang_item('note'), 'data' => 'contact_note'],
                        ['title' => lang_item('group'), 'data' => 'contact_group'],
                        ['title' => lang_item('status'), 'data' => 'contact_status'],
                        ['title' => lang_item('action'), 'data' => 'contact_action']
                    ],
                    'columnDefs' => [
                        ['className' => 'text-center', 'targets' => [0, 1, 3, 4, 5]]
                    ],
                    'order' => [
                        [0, "asc"]
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
                            'text' => '<i class="fa fa-upload"></i> '.lang_item('import'),
                            'className' => 'btn-pink',
                            'action' => ['arguments' => 'e,dt,node,config', 'body' => '$(\'.import-sms-contact\').modal(\'show\');']
                        ],
                        [
                            'text' => '<i class="fa fa-plus"></i> '.lang_item('add'),
                            'className' => 'btn-custom',
                            'action' => ['arguments' => 'e,dt,node,config', 'body' => '$(\'.add-sms-contact\').modal(\'show\');']
                        ]
                    ]
                ]);
            ?>
        </div>
    </div>
</div>

<?php
    $this->load->view('superadmin/sms/add_contact');
    $this->load->view('superadmin/sms/import_contact');
    $this->load->view('superadmin/sms/edit_contact');
?>