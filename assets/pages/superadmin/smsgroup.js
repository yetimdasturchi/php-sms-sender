(function ($) {

    'use strict';

    $(document).on("click", ".add-sms-submit", function (event) {
        event.preventDefault();
        this.blur();
        var smsname = $('.add-sms-group-name');
        var smsnote = $('.add-sms-group-note');
        $.ajax({
			url: backSet.base_url+'sms/insertdata/group',
            method: "POST",
            data: { name: smsname.val(), note: smsnote.val(), [backSet.csrf_hash_name]: backSet.csrf_hash}
        }).done(function(response) {
        	backSet.csrf_hash = response.hash;
            if (response.status == 'ok') {
            	$.growl.notice({ title: '', message: response.message});
            	$dtables['smsgroups'].ajax.reload();
            	$('.add-sms-group').modal('hide');
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
        var smsname = $('.edit-sms-group-name');
        var smsnote = $('.edit-sms-group-note');
        var id = $(this).attr('data-id');
        $.ajax({
			url: backSet.base_url+'sms/updatedata/group',
            method: "POST",
            data: { id: id, name: smsname.val(), note: smsnote.val(), [backSet.csrf_hash_name]: backSet.csrf_hash}
        }).done(function(response) {
            backSet.csrf_hash = response.hash;
            if (response.status == 'ok') {
            	$.growl.notice({ title: '', message: response.message});
            	$dtables['smsgroups'].ajax.reload();
                $('.edit-sms-group').modal('hide');
                smsname.val('');
                smsnote.val('');
            }else{
            	$.growl.error({ title: '', message: response.message});
            }
        }).fail(function( jqXHR, textStatus ) {
        	$.growl.error({ title: '', message: $app.spec.getLang('error_connection')});
        });
    });

    $(document).on("click", "[delete-group]", function (event) {
        event.preventDefault();
        var id = $(this).attr('delete-group');
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
				url: backSet.base_url+'sms/deletedata/group',
            	method: "POST",
            	data: { id: id, [backSet.csrf_hash_name]: backSet.csrf_hash}
        	}).done(function(response) {
        		backSet.csrf_hash = response.hash;
            	if (response.status == 'ok') {
            		$.growl.notice({ title: '', message: response.message});
            		$dtables['smsgroups'].ajax.reload();
            	}else{
            		$.growl.error({ title: '', message: response.message});
            	}
        	}).fail(function( jqXHR, textStatus ) {
        		$.growl.error({ title: '', message: $app.spec.getLang('error_connection')});
        	});
        });
    });

    $(document).on("click", "[edit-group]", function (event) {
        event.preventDefault();
        var id = $(this).attr('edit-group');
        $.ajax({
			url: backSet.base_url+'sms/getdata/single_group',
            method: "POST",
            data: { id: id, [backSet.csrf_hash_name]: backSet.csrf_hash}
        }).done(function(response) {
        	backSet.csrf_hash = response.hash;
        	if (response.status == 'ok') {
            	$('.edit-sms-group-name').val(response.content.name);
            	$('.edit-sms-group-note').val(response.content.note);
            	$('.edit-sms-submit').attr('data-id', id);
            	$('.edit-sms-group').modal('show');
            }else{
            	$.growl.error({ title: '', message: response.message});
            }
        }).fail(function( jqXHR, textStatus ) {
        	$.growl.error({ title: '', message: $app.spec.getLang('error_connection')});
        });
    });
    

})(jQuery)