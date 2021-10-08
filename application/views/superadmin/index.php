<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $data['meta_title'];?></title>
        
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="<?php echo $data['meta_description'];?>" name="description" />
        <meta content="<?php echo lang_item('meta_author', [], false);?>" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta property="og:image" content="<?php echo $data['meta_og_image'];?>">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('assets/images/favicon/apple-touch-icon.png')?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/images/favicon/favicon-32x32.png')?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/images/favicon/favicon-16x16.png')?>">
        <link rel="manifest" href="<?php echo base_url('assets/images/favicon/site.webmanifest')?>">
        <link rel="mask-icon" href="<?php echo base_url('assets/images/favicon/safari-pinned-tab.svg')?>" color="#5bbad5">
        
        <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/icons.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/metismenu.min.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/jquery.growl.css')?>" rel="stylesheet" type="text/css" />
        <?php
            if (array_key_exists('before', $data['css'])) {
                foreach ($data['css']['before'] as $css) {
        ?>
                    <link rel="stylesheet" href="<?php echo $css;?>" type="text/css" />
        <?php            
                }
            }
        ?>
        <link href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet" type="text/css" />
        <?php
            if (array_key_exists('after', $data['css'])) {
                foreach ($data['css']['after'] as $css) {
        ?>
                    <link rel="stylesheet" href="<?php echo $css;?>" type="text/css" />
        <?php            
                }
            }
        ?>
        <?php
            if (get_cookie('adjust') == 'dark') {
        ?>
            <link rel="stylesheet" href="<?php echo base_url('assets/css/dark.css')?>" id="darkcss" type="text/css" />
        <?php
            }
        ?>
        <script src="<?php echo base_url('assets/js/modernizr.min.js')?>"></script>
    </head>
    <body>
        <div id="wrapper">
            <?php
                $this->load->view('superadmin/topbar');
                $this->load->view('superadmin/sidemenu');
            ?>

            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left"><?php echo $data['section_title'];?></h4>
                                    <?php
                                        if (count($data['section_breadcrumb']) > 0) {
                                            echo '<ol class="breadcrumb float-right">';
                                                foreach ($data['section_breadcrumb'] as $breadcrumb) {
                                                    echo '<li class="breadcrumb-item">';
                                                        if (array_key_exists('url', $breadcrumb)) {
                                                            echo "<a href=\"{$breadcrumb['url']}\">{$breadcrumb['text']}</a>";
                                                        }else{
                                                            echo $breadcrumb['text'];
                                                        }
                                                    echo '</li>';
                                                }
                                            echo '</ol>';
                                        }
                                    ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                        <?php
                            $this->load->view($data['section'], ['section_data' => $data['section_data']]);
                        ?>
                    </div>
                </div>
                <footer class="footer text-right">
                    <?php echo lang_item('copyright', ['this_year' => date('Y')]);?>
                </footer>
            </div>
        </div>


        <script src="<?php echo base_url('settings.js')?>" id=""></script>
        <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/tether.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/metisMenu.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/waves.js')?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.slimscroll.js')?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.mask.js')?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.growl.js')?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.core.js')?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.app.js')?>"></script>
        
        <?php
            if (array_key_exists('before', $data['js'])) {
                foreach ($data['js']['before'] as $js) {
        ?>
                    <script src="<?php echo $js;?>"></script>
        <?php            
                }
            }
        ?>

        <script src="<?php echo base_url('assets/js/app.js')?>"></script>
        <?php
            if (array_key_exists('after', $data['js'])) {
                foreach ($data['js']['after'] as $js) {
        ?>
                    <script src="<?php echo $js;?>"></script>
        <?php            
                }
            }
        ?>
    </body>
</html>
