(function ($) {

    'use strict';
    $('.tooltip-animation').tooltipster({animation: 'grow'});
    $(document).ajaxComplete(function(event,xhr,options){
        $('.tooltip-animation').not('.tooltipstered').tooltipster({animation: 'grow', contentAsHTML: true});
    });
    $(document).on("click", ".add-sms-submit", function (event) {
        event.preventDefault();
        this.blur();
        var smskey = $('.add-sms-template-key');
        var smsstatus = $('.add-sms-template-status');
        var smstext = $('.add-sms-template-text');
        $.ajax({
			url: backSet.base_url+'sms/insertdata/template',
            method: "POST",
            data: { key: smskey.val(), status: smsstatus.val(), text: smstext.val(), [backSet.csrf_hash_name]: backSet.csrf_hash}
        }).done(function(response) {
        	backSet.csrf_hash = response.hash;
            if (response.status == 'ok') {
            	$.growl.notice({ title: '', message: response.message});
            	$dtables['smstemplates'].ajax.reload();
            	$('.add-sms-template').modal('hide');
            	smskey.val('');
            	smsstatus.val('');
            	smstext.val('');
            }else{
            	$.growl.error({ title: '', message: response.message});
            }
        }).fail(function( jqXHR, textStatus ) {
        	$.growl.error({ title: '', message: $app.spec.getLang('error_connection')});
        });
    });

    $(document).on("click", ".edit-sms-submit", function (event) {
        event.preventDefault();
        this.blur();
        var smskey = $('.edit-sms-template-key');
        var smsstatus = $('.edit-sms-template-status');
        var smstext = $('.edit-sms-template-text');
        var id = $(this).attr('data-id');
        $.ajax({
			url: backSet.base_url+'sms/updatedata/template',
            method: "POST",
            data: { id: id, key: smskey.val(), status: smsstatus.val(), text: smstext.val(), [backSet.csrf_hash_name]: backSet.csrf_hash}
        }).done(function(response) {
        	backSet.csrf_hash = response.hash;
            if (response.status == 'ok') {
            	$.growl.notice({ title: '', message: response.message});
            	$dtables['smstemplates'].ajax.reload();
            	$('.edit-sms-template').modal('hide');
            	smskey.val('');
            	smsstatus.val('');
            	smstext.val('');
            }else{
            	$.growl.error({ title: '', message: response.message});
            }
        }).fail(function( jqXHR, textStatus ) {
        	$.growl.error({ title: '', message: $app.spec.getLang('error_connection')});
        });
    });

    $(document).on("change", ".add-sms-template-key, .edit-sms-template-key", function (event) {
        event.preventDefault();
        var val = $(this).val();
        $(this).val( $app.utils.toUniversalString(val, {delimiter: '_'}) );
    });

    $(document).on("change", ".add-sms-template-text, .edit-sms-template-text", function (event) {
        event.preventDefault();
        var val = $(this).val();
        $(this).val( $app.utils.toUniversalString(val, {delimiter: ' ', lowercase: false, nonAlpha: true}) );
    });

    $(document).on("cut, paste, keydown", ".add-sms-template-text, .edit-sms-template-text", function (event) {
        var val = $(this).val();
        var residue = (160-val.length);
        $('.add-sms-template-text-counter, .edit-sms-template-text-counter').text((residue < 0) ? ` (0)` : ` (${residue})`);
        if (val.length > 159) {
        	$.growl.error({ title: '', message: $app.spec.getLang('smstext_max_chars').replace(/{count}/g, smsConfig.max_sms_chars)});
        	if(event.keyCode!=8){
        		event.preventDefault();
        	}
        }
    });

    $(document).on("click", "[delete-template]", function (event) {
        event.preventDefault();
        var id = $(this).attr('delete-template');
        swal({
			title: $app.spec.getLang('do_you_delete_this'),
			content: '',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f7951d',
            cancelButtonColor: '#1b1d1c',
            confirmButtonText: $app.spec.getLang('yes'),
            cancelButtonText: $app.spec.getLang('no')
        }).then(function () {
        	$.ajax({
				url: backSet.base_url+'sms/deletedata/template',
            	method: "POST",
            	data: { id: id, [backSet.csrf_hash_name]: backSet.csrf_hash}
        	}).done(function(response) {
        		backSet.csrf_hash = response.hash;
            	if (response.status == 'ok') {
            		$.growl.notice({ title: '', message: response.message});
            		$dtables['smstemplates'].ajax.reload();
            	}else{
            		$.growl.error({ title: '', message: response.message});
            	}
        	}).fail(function( jqXHR, textStatus ) {
        		$.growl.error({ title: '', message: $app.spec.getLang('error_connection')});
        	});
        });
    });

    $(document).on("click", "[edit-template]", function (event) {
        event.preventDefault();
        var id = $(this).attr('edit-template');
        $.ajax({
			url: backSet.base_url+'sms/getdata/single_template',
            method: "POST",
            data: { id: id, [backSet.csrf_hash_name]: backSet.csrf_hash}
        }).done(function(response) {
        	backSet.csrf_hash = response.hash;
            console.log(response);
        	if (response.status == 'ok') {
            	$('.edit-sms-template-key').removeAttr( "readonly" ).val(response.content.key);
            	$('.edit-sms-template-status').removeAttr( "readonly" ).val(response.content.status);
            	$('.edit-sms-template-text').val(response.content.text);
            	$('.edit-sms-submit').attr('data-id', id);
                if (response.content.type == "0") {
                    $('.edit-sms-template-key').attr('readonly', '');
                    $('.edit-sms-template-status').attr('readonly', '');
                }
            	$('.edit-sms-template').modal('show');
            }else{
            	$.growl.error({ title: '', message: response.message});
            }
        }).fail(function( jqXHR, textStatus ) {
        	$.growl.error({ title: '', message: $app.spec.getLang('error_connection')});
        });
    });
    

})(jQuery)