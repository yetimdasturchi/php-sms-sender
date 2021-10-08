<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li class="menu-title"><?php echo lang_item('navigation');?></li>
                <li>
                    <a href="<?php echo base_url('dashboard')?>">
                        <i class="fi-air-play"></i><span> <?php echo lang_item('dashboard');?></span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fi-mail"></i><span> <?php echo lang_item('sms_messages');?> </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?php echo base_url('sms/send');?>"><?php echo lang_item('sms_messages_send');?></a></li>
                        <li><a href="<?php echo base_url('sms/records');?>"><?php echo lang_item('sms_messages_list');?></a></li>
                        <li><a href="<?php echo base_url('sms/contacts');?>"><?php echo lang_item('sms_messages_contacts');?></a></li>
                        <li><a href="<?php echo base_url('sms/groups');?>"><?php echo lang_item('sms_messages_groups');?></a></li>
                        <li><a href="<?php echo base_url('sms/templates');?>"><?php echo lang_item('sms_messages_templates');?></a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>