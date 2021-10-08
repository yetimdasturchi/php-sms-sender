(function ($) {

    'use strict';
    $('.tooltip-animation').tooltipster({animation: 'grow'});
    $(document).ajaxComplete(function(event,xhr,options){
    	$('.tooltip-animation').not('.tooltipstered').tooltipster({animation: 'grow', contentAsHTML: true});
	});

	var updateStatus = function() {
		//$dtables['smsrecords'].ajax.reload(null, false);
		$.post( backSet.base_url+'sms/getdata/recordscounter', { [backSet.csrf_hash_name]: backSet.csrf_hash }, function( data ) {
  			backSet.csrf_hash = data.hash;
  			$('.all-smsmessages-counter').text(data.content.all_smsmessages);
  			$('.messages-in-progress-counter').text(data.content.messages_in_progress);
  			$('.messages-sent-counter').text(data.content.messages_sent);
  			$dtables['smsrecords'].ajax.reload(null, false);
		});
		setTimeout(updateStatus, 10000);
	}
	setTimeout(updateStatus, 10000);
	$.fn.sendingstatus = function(el) {
		console.log(el);
    	$.post( backSet.base_url+'sms/updatedata/sendingstatus', {[backSet.csrf_hash_name]: backSet.csrf_hash }, function( data ) {
			console.log(data)
			backSet.csrf_hash = data.hash;
  			if (data.content.status == 'true') {
  				$(el).html('<span><i class="fa fa-pause"></i></span>').removeClass('btn-warning').addClass('btn-danger');
  			}else{
  				$(el).html('<span><i class="fa fa-play"></i></span>').removeClass('btn-danger').addClass('btn-warning');
  			}
  			$.growl.notice({ title: '', message: data.message});
		});
  	}

  	$(document).on("click", "[resend-sms]", function (event) {
        event.preventDefault();
        var id = $(this).attr('resend-sms');
        console.log(id);
       	swal({
            title: $app.spec.getLang('do_you_resend_this_sms'),
            content: '',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f7951d',
            cancelButtonColor: '#1b1d1c',
            confirmButtonText: $app.spec.getLang('yes'),
            cancelButtonText: $app.spec.getLang('no')
        }).then(function () {
            $.ajax({
                url: backSet.base_url+'sms/updatedata/resendsms',
                method: "POST",
                data: { id: id, [backSet.csrf_hash_name]: backSet.csrf_hash}
            }).done(function(response) {
                backSet.csrf_hash = response.hash;
                if (response.status == 'ok') {
                    $.growl.notice({ title: '', message: response.message});
                    $dtables['smsrecords'].ajax.reload();
                }else{
                    $.growl.error({ title: '', message: response.message});
                }
            }).fail(function( jqXHR, textStatus ) {
                $.growl.error({ title: '', message: $app.spec.getLang('error_connection')});
            });
        });
    });

    $(document).on("click", "[delete-sms]", function (event) {
        event.preventDefault();
        var id = $(this).attr('delete-sms');
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
				url: backSet.base_url+'sms/deletedata/sms',
            	method: "POST",
            	data: { id: id, [backSet.csrf_hash_name]: backSet.csrf_hash}
        	}).done(function(response) {
        		backSet.csrf_hash = response.hash;
            	if (response.status == 'ok') {
            		$.growl.notice({ title: '', message: response.message});
            		$dtables['smsrecords'].ajax.reload();
            	}else{
            		$.growl.error({ title: '', message: response.message});
            	}
        	}).fail(function( jqXHR, textStatus ) {
        		$.growl.error({ title: '', message: $app.spec.getLang('error_connection')});
        	});
        });
    });
})(jQuery)