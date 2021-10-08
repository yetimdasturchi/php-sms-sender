<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <form role="form" class="sendmessage">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang_item('groups_or_number_to_send');?></label>
                            <select class="form-control select2" multiple="" name="group[]">
                                <?php
                                    foreach ($this->db->get('gsmcontact_groups')->result_array() as $group) {
                                        echo '<option value="group_'.$group['contactgroup_id'].'">'.$group['contactgroup_name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang_item('sendto_date');?></label>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control senddate" name="senddate" value="<?php echo date("m/d/Y");?>">
                                    <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                </div><!-- input-group -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang_item('sendto_time');?></label>
                            <div class="input-group">
                                <input type="text" class="form-control sendtime" name="sendtime" value="<?php echo date("H:i");?>">
                                <span class="input-group-addon"><i class="mdi mdi-clock"></i></span>
                            </div><!-- input-group -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang_item('sendto_importance');?></label>
                            <select class="form-control" name="sendimportance">
                                <option value="0"><?php echo lang_item('default');?></option>
                                <option value="1"><?php echo lang_item('speedify');?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang_item('sms_messages_templates');?></label>
                            <select class="form-control sendtemplate">
                                <option value="0"><?php echo lang_item('select');?></option>
                                <?php
                                    foreach ($this->db->where('smstemplate_status', '1')->where('smstemplate_type', '1')->get('gsmtemplates')->result_array() as $template) {
                                        echo '<option value="'.$template['smstemplate_id'].'">'.$template['smstemplate_text'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang_item('text');?></label>
                            <textarea class="form-control sendtext" name="sendtext" maxlength="160" rows="3" style="resize: none;" placeholder=""></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-inverse waves-effect waves-light btn-block"><?php echo lang_item('send');?></button>
            </form>
        </div>
    </div>
</div>