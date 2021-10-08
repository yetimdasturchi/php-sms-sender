var resizefunc = [];
var backSet = {
	base_url: "<?php echo base_url();?>",
    default_lang: "<?php echo $this->config->item('language');?>",
    csrf_hash_name: "<?php echo $this->security->get_csrf_token_name(); ?>",
    csrf_hash: "<?php echo $this->security->get_csrf_hash(); ?>",
    languages: <?php echo json_encode(get_languages());?>,
    language: <?php echo json_encode($this->lang->language);?>
}