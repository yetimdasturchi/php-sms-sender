<div class="modal fade edit-sms-group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?php echo lang_item('edit_group');?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-1" class="control-label"><?php echo lang_item('group_name');?></label>
                            <input type="text" class="form-control edit-sms-group-name" name="name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group no-margin">
                            <label for="field-7" class="control-label"><?php echo lang_item('note');?></label>
                            <textarea class="form-control edit-sms-group-note" name="note" style="resize: none;"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><?php echo lang_item('cancel');?></button>
                <button type="button" class="btn btn-custom waves-effect waves-light edit-sms-submit"><?php echo lang_item('save');?></button>
            </div>
        </div>
    </div>
</div>