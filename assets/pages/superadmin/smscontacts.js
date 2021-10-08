(function ($) {

    'use strict';

    $(document).on("click", ".add-sms-submit", function (event) {
        event.preventDefault();
        this.blur();
        var smsphone = $('.add-sms-contact-phone');
        var smsname = $('.add-sms-contact-name');
        var smsgroup = $('.add-sms-contact-group');
        var smsstatus = $('.add-sms-contact-status');
        var smsnote = $('.add-sms-contact-note');
        $.ajax({
			url: backSet.base_url+'sms/insertdata/contact',
            method: "POST",
            data: { phone: smsphone.val(), name: smsname.val(), group: smsgroup.val(), status: smsstatus.val(), note: smsnote.val(), [backSet.csrf_hash_name]: backSet.csrf_hash}
        }).done(function(response) {
        	backSet.csrf_hash = response.hash;
            if (response.status == 'ok') {
            	$.growl.notice({ title: '', message: response.message});
            	$dtables['smscontacts'].ajax.reload();
            	$('.add-sms-contact').modal('hide');
            	smsname.val('');
            	smsnote.val('');
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
        var smsphone = $('.edit-sms-contact-phone');
        var smsname = $('.edit-sms-contact-name');
        var smsgroup = $('.edit-sms-contact-group');
        var smsstatus = $('.edit-sms-contact-status');
        var smsnote = $('.edit-sms-contact-note');
        var id = $(this).attr('data-id');
        $.ajax({
			url: backSet.base_url+'sms/updatedata/contact',
            method: "POST",
            data: { id: id, phone: smsphone.val(), name: smsname.val(), group: smsgroup.val(), status: smsstatus.val(), note: smsnote.val(), [backSet.csrf_hash_name]: backSet.csrf_hash}
        }).done(function(response) {
            backSet.csrf_hash = response.hash;
            if (response.status == 'ok') {
            	$.growl.notice({ title: '', message: response.message});
            	$dtables['smscontacts'].ajax.reload();
                $('.edit-sms-contact').modal('hide');
                smsphone.val('');
                smsname.val('');
                smsgroup.val('');
                smsstatus.val('');
                smsnote.val('');
            }else{
            	$.growl.error({ title: '', message: response.message});
            }
        }).fail(function( jqXHR, textStatus ) {
        	$.growl.error({ title: '', message: $app.spec.getLang('error_connection')});
        });
    });

    $(document).on("click", "[delete-contact]", function (event) {
        event.preventDefault();
        var id = $(this).attr('delete-contact');
        swal({
			title: $app.spec.getLang('do_you_delete_this'),
			content: '',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d57171',
            cancelButtonColor: '#64c5b1',
            confirmButtonText: $app.spec.getLang('yes'),
            cancelButtonText: $app.spec.getLang('no')
        }).then(function () {
        	$.ajax({
				url: backSet.base_url+'sms/deletedata/contact',
            	method: "POST",
            	data: { id: id, [backSet.csrf_hash_name]: backSet.csrf_hash}
        	}).done(function(response) {
        		backSet.csrf_hash = response.hash;
            	if (response.status == 'ok') {
            		$.growl.notice({ title: '', message: response.message});
            		$dtables['smscontacts'].ajax.reload();
            	}else{
            		$.growl.error({ title: '', message: response.message});
            	}
        	}).fail(function( jqXHR, textStatus ) {
        		$.growl.error({ title: '', message: $app.spec.getLang('error_connection')});
        	});
        });
    });

    $(document).on("click", "[edit-contact]", function (event) {
        event.preventDefault();
        var id = $(this).attr('edit-contact');
        $.ajax({
			url: backSet.base_url+'sms/getdata/single_contact',
            method: "POST",
            data: { id: id, [backSet.csrf_hash_name]: backSet.csrf_hash}
        }).done(function(response) {
        	backSet.csrf_hash = response.hash;
        	if (response.status == 'ok') {
            	$('.edit-sms-contact-phone').mask($app.spec.getLang('phone_format')).val(response.content.phone).trigger('input');
            	$('.edit-sms-contact-name').val(response.content.name);
                $('.edit-sms-contact-group').val(response.content.group);
                $('.edit-sms-contact-status').val(response.content.status);
                $('.edit-sms-contact-note').val(response.content.note);
            	$('.edit-sms-submit').attr('data-id', id);
            	$('.edit-sms-contact').modal('show');
            }else{
            	$.growl.error({ title: '', message: response.message});
            }
        }).fail(function( jqXHR, textStatus ) {
        	$.growl.error({ title: '', message: $app.spec.getLang('error_connection')});
        });
    });

    $(document).on("click", ".import-sms-submit", function (event) {
        event.preventDefault();
        $('.import-sms-contact-form').submit();                       
    });

    $(document).on("submit", ".import-sms-contact-form", function(event) {
        event.preventDefault();
        var form = this;
        var form_data = new FormData(form);
        form_data.append([backSet.csrf_hash_name], backSet.csrf_hash);
        $.ajax({
            url: backSet.base_url+'sms/insertdata/importcontact',
            method: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData:false, 
        }).done(function(response) {
            backSet.csrf_hash = response.hash;
            if (response.status == 'ok') {
                $dtables['smscontacts'].ajax.reload();
                $(form)[0].reset();
                $('.import-sms-contact').modal('hide');
            }else{
                $.growl.error({ title: '', message: response.message});
            }
        }).fail(function( jqXHR, textStatus ) {
            console.log(jqXHR);
            $.growl.error({ title: '', message: $app.spec.getLang('error_connection')});
        });
    });
    

})(jQuery)