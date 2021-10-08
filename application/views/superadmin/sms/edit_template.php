<div class="modal fade edit-sms-template" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?php echo lang_item('edit_template');?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="control-label"><?php echo lang_item('key');?></label>
                            <input type="text" class="form-control edit-sms-template-key" name="key">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-2" class="control-label"><?php echo lang_item('status');?></label>
                            <select class="form-control edit-sms-template-status" name="status">
                                <option value="1"><?php echo lang_item('active');?></option>
                                <option value="0"><?php echo lang_item('unactive');?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group no-margin">
                            <label for="field-7" class="control-label"><?php echo lang_item('text');?><span class="edit-sms-template-text-counter"></span></label>
                            <textarea class="form-control edit-sms-template-text" name="text" style="resize: none;"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><?php echo lang_item('cancel');?></button>
                <button type="button" class="btn btn-custom waves-effect waves-light edit-sms-submit" data-id="0"><?php echo lang_item('save');?></button>
            </div>
        </div>
    </div>
</div>