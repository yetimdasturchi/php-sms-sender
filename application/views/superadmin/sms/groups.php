<div class="row">
    <div class="col-12">
        <div class="card-box">
            <?php
                echo datatableGen('smsgroups', [
                    'class' => 'table table-striped m-0 table-actions-bar dt-responsive nowrapdt-head-right',
                    'id' => 'test',
                    'cellspacing' => '0',
                    'style' => 'width:100%;',
                ], [
                    'processing' => true,
                    'serverSide' => true,
                    'serverMethod' => 'post',
                    'ajax' => [
                        'url' => base_url('sms/getdata/groups'),
                        'cache' => false
                    ],
                    'columns' => [
                        ['title' => lang_item('hashtag'), 'data' => 'contactgroup_id'],
                        ['title' => lang_item('group'), 'data' => 'contactgroup_name'],
                        ['title' => lang_item('note'), 'data' => 'contactgroup_note'],
                        ['title' => lang_item('action'), 'data' => 'contactgroup_action']
                    ],
                    'columnDefs' => [
                        ['className' => 'text-center', 'targets' => [0, 1, 3]]
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
                            'action' => ['arguments' => 'e,dt,node,config', 'body' => '$(\'.add-sms-group\').modal(\'show\');']
                        ]
                    ]
                ]);
            ?>
        </div>
    </div>
</div>

<?php
    $this->load->view('superadmin/sms/add_group');
    $this->load->view('superadmin/sms/edit_group');
?>

<script type="text/javascript">
    var smsConfig = {
        max_sms_chars: <?php echo $this->config->item('max_sms_chars');?>,
    }
</script>