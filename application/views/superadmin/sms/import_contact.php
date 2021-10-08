<div class="modal fade import-sms-contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?php echo lang_item('import_contact');?></h4>
            </div>
            <div class="modal-body">
                <form class="import-sms-contact-form" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-1" class="control-label"><?php echo lang_item('phone_numbers_file');?> <span class="text-danger">(xlsx, vcf, json)</span></label>
                            <input type="file" class="filestyle import-sms-contact-file" name="file" data-buttontext="<?php echo lang_item('select_file')?>" accept=".xlsx, .vcf, .json" data-buttonname="btn-custom">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-2" class="control-label"><?php echo lang_item('group');?></label>
                            <select class="form-control import-sms-contact-group" name="group">
                                <option value="0"><?php echo lang_item('select');?></option>
                                <?php
                                    foreach ($this->db->get('gsmcontact_groups')->result_array() as $group) {
                                        echo '<option value="'.$group['contactgroup_id'].'">'.$group['contactgroup_name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-2" class="control-label"><?php echo lang_item('status');?></label>
                            <select class="form-control import-sms-contact-status" name="status">
                                <option value="1"><?php echo lang_item('active');?></option>
                                <option value="0"><?php echo lang_item('unactive');?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group no-margin">
                            <label for="field-7" class="control-label"><?php echo lang_item('note');?></label>
                            <textarea class="form-control import-sms-contact-note" name="note" style="resize: none;"></textarea>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><?php echo lang_item('cancel');?></button>
                <button type="button" class="btn btn-custom waves-effect waves-light import-sms-submit"><?php echo lang_item('add');?></button>
            </div>
        </div>
    </div>
</div>