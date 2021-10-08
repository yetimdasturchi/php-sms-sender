<div class="topbar">
    <div class="topbar-left">
        <a href="<?php echo base_url()?>" class="logo">
            <span><?php echo base_host();?></span>
            <i><?php substr(base_host(), 0, 2)?>MY</i>
        </a>
    </div>
    <nav class="navbar-custom">
        <ul class="list-inline float-right mb-0">
            <!--<li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="dripicons-bell noti-icon"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                    <div class="dropdown-item noti-title">
                        <h5><?php echo lang_item('notofication');?></h5>
                    </div>
                    <p class="text-muted text-center mt-2"><?php echo lang_item('notofication_not_found');?></p>
                    <a href="<?php echo user_base_url('notofications')?>" class="dropdown-item notify-item notify-all">
                        <?php echo lang_item('view_all');?>
                    </a>

                </div>
            </li>-->

            <li class="list-inline-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user topbar-languageselector" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <?php echo get_language_info('', 'short_name')?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" style="min-width: unset;" aria-labelledby="Preview">
                <?php
                    foreach (get_languages() as $language) {
                        if ($language['key'] != $this->config->item('language')) {
                ?>
                            <a set-lang="<?php echo $language['key']?>" class="dropdown-item topbar-languageitem">
                                <i class="flag-icon flag-icon-<?php echo $language['flagicon']?>"></i> <span><?php echo $language['name'];?></span>
                            </a> 
                <?php
                        }
                    }
                ?>
                </div>
            </li>

            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="<?php echo uploads('avatars', $this->session->userdata('user_avatar'));?>" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                    <div class="dropdown-item noti-title">
                        <h5 class="text-overflow"><small><?php echo $this->session->userdata('user_lastname').' '.$this->session->userdata('user_firstname');?></small> </h5>
                    </div>
                    <!--<a href="<?php echo user_base_url('profile')?>" class="dropdown-item notify-item">
                        <i class="zmdi zmdi-account-circle"></i> <span><?php echo lang_item('profile');?></span>
                    </a>
                    <a href="<?php echo user_base_url('settings')?>" class="dropdown-item notify-item">
                        <i class="zmdi zmdi-settings"></i> <span><?php echo lang_item('settings');?></span>
                    </a>-->
                    <a href="<?php echo base_url('logout')?>" class="dropdown-item notify-item">
                        <i class="zmdi zmdi-power"></i> <span><?php echo lang_item('logout');?></span>
                    </a>
                </div>
            </li>
        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-light waves-effect">
                    <i class="dripicons-menu"></i>
                </button>
            </li>
            <!--<li class="hide-phone app-search">
                <form role="search" class="">
                    <input type="text" placeholder="<?php echo lang_item('search');?>" class="form-control">
                    <a href=""><i class="fa fa-search"></i></a>
                </form>
            </li>-->
        </ul>
    </nav>
</div>
