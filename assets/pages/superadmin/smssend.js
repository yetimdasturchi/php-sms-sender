(function ($) {

    'use strict';
    $('.sendtext').maxlength({
    	alwaysShow: true
	});

	$('.senddate').datepicker({autoclose: true, language: backSet.default_lang});

	$('.sendtime').timepicker({
        showMeridian: false,
        icons: {
            up: 'mdi mdi-chevron-up',
            down: 'mdi mdi-chevron-down'
        }
    });

    $(".select2").select2({
    	tags: true,
    	tokenSeparators: [',', ' '],
    	language: {
    		noResults: function () {
                return $app.spec.getLang('select2_not_results_found');
            },
            searching: function () {
            	return $app.spec.getLang('select2_searching');
            },
		},
    	createTag: function (params) {
    		var term = $.trim(params.term);
    		if (term === '') {
      			return null;
    		}
    		
    		var number = term.replace(/\D/g, '');
    		if (number.length > 11) {
    			var rg = /^998(90|91|93|94|95|97|98|99|33|88)[0-9]{7}$/g
    			if (rg.test(number)) {
    				var rgp = /^(998)(90|91|93|94|95|97|98|99|33|88)([0-9]{3})([0-9]{2})([0-9]{2})$/g;
    				var format = number.replace(rgp, "+$1 ($2) $3-$4-$5");
    				return {
      					id: number,
      					text: format
    				}
    			}
    		}else{
    			if (term.length > 3) {
    				var tmp = null;
    				$.ajax({
        				async: false,
        				type: "POST",
        				global: false,
        				url: backSet.base_url+'sms/getdata/search_number',
        				data: { q: term, [backSet.csrf_hash_name]: backSet.csrf_hash },
        				'success': function (data) {
        					backSet.csrf_hash = data.hash;
            				tmp = data.content;
        				}
    				});
    				if (tmp != null) {
    					return tmp;
    				}
    			}
    		}
    		return null;	
  		}
    });

    $(document).on("change", ".sendtemplate", function (event) {
    	var id = $(this).val();
    	if (id == 0) {
    		$('.sendtext').val('');
    	}else{
    		$.post( backSet.base_url+'sms/getdata/single_template', {id: id, [backSet.csrf_hash_name]: backSet.csrf_hash }, function( data ) {
  				backSet.csrf_hash = data.hash;
  				$('.sendtext').val(data.content.text);
			});
    	}
    });

    $(document).on("submit", ".sendmessage", function (event) {
    	event.preventDefault();
    	var formdata = $( this ).serializeArray();
    	formdata.push({name: backSet.csrf_hash_name, value: backSet.csrf_hash});
    	$.ajax({
			url: backSet.base_url+'sms/insertdata/sendmessage',
            method: "POST",
            data: formdata
        }).done(function(response) {
        	backSet.csrf_hash = response.hash;
        	if (response.status == 'ok') {
            	$.growl.notice({ title: '', message: response.message});
            	setTimeout(function(){ window.location.href =  response.redirect;}, 3000);
            }else{
            	$.growl.error({ title: '', message: response.message});
            }
        }).fail(function( jqXHR, textStatus ) {
        	$.growl.error({ title: '', message: $app.spec.getLang('error_connection')});
        });
    });
})(jQuery)
