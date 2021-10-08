<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php echo lang_item('sitetitle', [], false);?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="<?php echo lang_item('meta_content', [], false);?>" name="description" />
        <meta content="<?php echo lang_item('meta_author', [], false);?>" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta property="og:image" content="<?php echo base_url('assets/images/opengraph.png')?>">
        <!-- App favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('assets/images/favicon/apple-touch-icon.png')?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/images/favicon/favicon-32x32.png')?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/images/favicon/favicon-16x16.png')?>">
        <link rel="manifest" href="<?php echo base_url('assets/images/favicon/site.webmanifest')?>">
        <link rel="mask-icon" href="<?php echo base_url('assets/images/favicon/safari-pinned-tab.svg')?>" color="#1b1d1c">
        <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon/favicon.ico')?>">
        <meta name="msapplication-TileColor" content="#1b1d1c">
        <meta name="msapplication-config" content="<?php echo base_url('assets/images/favicon/browserconfig.xml')?>">
        <meta name="theme-color" content="#1b1d1c">
        <!-- App css -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/icons.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/metismenu.min.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/jquery.growl.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet" type="text/css" />
        <?php
            if (get_cookie('adjust') == 'dark') {
        ?>
            <link rel="stylesheet" href="<?php echo base_url('assets/css/dark.css')?>" id="darkcss" type="text/css" />
        <?php
            }
        ?>
        <script src="<?php echo base_url('assets/js/modernizr.min.js')?>"></script>
        
    </head>


    <body class="bg-accpunt-pages">
        <!-- HOME -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="account-pages">
                                <div class="account-box">
                                    <?php
                                        foreach (get_languages() as $lang) {
                                            if ($lang['key'] != $this->config->item('language')) {
                                    ?>
                                                <button type="button" class="btn btn-icon waves-effect waves-light btn-inverse login-set-lng" set-lang="<?php echo $lang['key']?>"> <?php echo $lang['short_name']?> </button>
                                    <?php
                                            }
                                        }
                                    ?>
                                    <button type="button" class="btn btn-icon waves-effect waves-light btn-inverse login-set-adjust"> <i class="fa fa-adjust"></i> </button>
                                    <div class="account-logo-box">
                                        <h2 class="text-uppercase text-center">
                                            <a href="<?php echo base_url();?>" class="text-success">
                                                <h3 class="text-uppercase font-bold"><?php echo lang_item('sign_in');?></h3>
                                            </a>
                                        </h2>
                                        
                                    </div>
                                    <div class="account-content">
                                        
                                        <?php
                                            $this->load->view('components/login_form');
                                        ?>

                                        <div class="row m-t-50">
                                            <div class="col-sm-12 text-center">
                                                <p class="text-muted"><?php echo lang_item('copyright', ['this_year' => date('Y')]);?></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end card-box-->


                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
          </section>
          <!-- END HOME -->
        <!-- jQuery  -->
        <script src="<?php echo base_url('settings.js')?>" id=""></script>
        <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/tether.min.js')?>"></script><!-- Tether for Bootstrap -->
        <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/metisMenu.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/waves.js')?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.slimscroll.js')?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.mask.js')?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.growl.js')?>"></script>
        <!-- Modal-Effect -->
        <script src="<?php echo base_url('assets/plugins/custombox/js/custombox.min.js')?>"></script>
        <script src="<?php echo base_url('assets/plugins/custombox/js/legacy.min.js')?>"></script>
        <!-- App js -->
        <script src="<?php echo base_url('assets/js/jquery.core.js')?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.app.js')?>"></script>
        <script src="<?php echo base_url('assets/js/app.js')?>"></script>

    </body>
</html>