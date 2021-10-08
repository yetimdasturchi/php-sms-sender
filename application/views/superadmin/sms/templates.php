<div class="row">
    <div class="col-12">
        <div class="card-box">
            <?php
                echo datatableGen('smstemplates', [
                    'class' => 'table table-striped m-0 table-actions-bar dt-responsive nowrapdt-head-right',
                    'id' => 'test',
                    'cellspacing' => '0',
                    'style' => 'width:100%;',
                ], [
                    'processing' => true,
                    'serverSide' => true,
                    'serverMethod' => 'post',
                    'ajax' => [
                        'url' => base_url('sms/getdata/templates'),
                        'cache' => false
                    ],
                    'fnRowCallback' => [
                        'arguments' => 'nRow, aData, iDisplayIndex, iDisplayIndexFull',
                        'body' => 'if ( aData[\'smstemplate_type\'] == "0" ){$(nRow).alterClass( \'tr-status-*\', \'tr-status-inverse\' );};'
                    ],
                    'columns' => [
                        ['title' => lang_item('hashtag'), 'data' => 'smstemplate_id'],
                        ['title' => lang_item('key'), 'data' => 'smstemplate_key'],
                        ['title' => lang_item('text'), 'data' => 'smstemplate_text'],
                        ['title' => lang_item('status'), 'data' => 'smstemplate_status'],
                        ['title' => lang_item('action'), 'data' => 'smstemplate_action']
                    ],
                    'columnDefs' => [
                        ['className' => 'text-center', 'targets' => [0, 3, 4]]
                    ],
                    'order' => [
                        [0, "asc"]
                    ],
                    'responsive' => false,
                    'buttonsDom' => 'Bfrtip',
                    'buttons' => [
                        [
                            'text' => '<i class="fa fa-plus"></i> '.lang_item('add'),
                            'className' => 'btn-custom',
                            'action' => ['arguments' => 'e,dt,node,config', 'body' => '$(\'.add-sms-template\').modal(\'show\');']
                        ]
                    ]
                ]);
            ?>
        </div>
    </div>
</div>

<?php
    $this->load->view('superadmin/sms/add_template');
    $this->load->view('superadmin/sms/edit_template');
?>

<script type="text/javascript">
    var smsConfig = {
        max_sms_chars: <?php echo $this->config->item('max_sms_chars');?>,
    }
</script>