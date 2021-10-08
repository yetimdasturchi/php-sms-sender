<div class="modal fade add-sms-contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?php echo lang_item('add_contact');?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="control-label"><?php echo lang_item('phone_number');?></label>
                            <input type="text" class="form-control phone-mask add-sms-contact-phone" name="phone">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="control-label"><?php echo lang_item('name');?></label>
                            <input type="text" class="form-control add-sms-contact-name" name="name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-2" class="control-label"><?php echo lang_item('group');?></label>
                            <select class="form-control add-sms-contact-group" name="group">
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
                            <select class="form-control add-sms-contact-status" name="status">
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
                            <textarea class="form-control add-sms-contact-note" name="note" style="resize: none;"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><?php echo lang_item('cancel');?></button>
                <button type="button" class="btn btn-custom waves-effect waves-light add-sms-submit"><?php echo lang_item('add');?></button>
            </div>
        </div>
    </div>
</div>