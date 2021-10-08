(function ( $ ) {
    
$.fn.alterClass = function ( removals, additions ) {
    
    var self = this;
    
    if ( removals.indexOf( '*' ) === -1 ) {
        // Use native jQuery methods if there is no wildcard matching
        self.removeClass( removals );
        return !additions ? self : self.addClass( additions );
    }

    var patt = new RegExp( '\\s' + 
            removals.
                replace( /\*/g, '[A-Za-z0-9-_]+' ).
                split( ' ' ).
                join( '\\s|\\s' ) + 
            '\\s', 'g' );

    self.each( function ( i, it ) {
        var cn = ' ' + it.className + ' ';
        while ( patt.test( cn ) ) {
            cn = cn.replace( patt, ' ' );
        }
        it.className = $.trim( cn );
    });

    return !additions ? self : self.addClass( additions );
};

})( jQuery );

var $app = {};
var $dtables = {};
(function ($) {

    'use strict';

    $app.form = {
    	login: function( phone ) {
    		if (phone.length == 0) {
                $.growl.error({ title: '', message: $app.spec.getLang('phone_not_entered'), location: 'tc' });
            }else if(phone.length < 19){
                $.growl.error({ title: '', message: $app.spec.getLang('phone_invalid_format'), location: 'tc' });
            }else{
                $.ajax({
                    url: backSet.base_url+'ajax/get_login_otp',
                    method: "POST",
                    data: { phone: phone, [backSet.csrf_hash_name]: backSet.csrf_hash}
                }).done(function(response) {
                    backSet.csrf_hash = response.hash;
                    if (response.status == 'ok') {
                        $.growl.notice({ title: '', message: response.message, location: 'tc' });
                        $('.site-auth').animate({opacity: '0'}, 150, function(){
                            $('.site-auth').animate({height: '0px'}, 150, function(){
                                $('.site-auth').remove();
                                $('.account-content').html(response.html);
                            });
                        });
                        
                    }else{
                        $.growl.error({ title: '', message: response.message, location: 'tc' });
                    }
                }).fail(function( jqXHR, textStatus ) {
                    $.growl.error({ title: '', message: $app.spec.getLang('error_connection'), location: 'tc' });
                    
                });
                
            }
    	},
        loginOtp: function( code ) {
            if (code.length == 0) {
                $.growl.error({ title: '', message: $app.spec.getLang('otp_not_entered'), location: 'tc' });
            }else if(code.length < 6){
                $.growl.error({ title: '', message: $app.spec.getLang('entered_otp_error'), location: 'tc' });
            }else{
                $.ajax({
                    url: backSet.base_url+'ajax/check_otp',
                    method: "POST",
                    data: { otp: code, [backSet.csrf_hash_name]: backSet.csrf_hash}
                }).done(function(response) {
                    backSet.csrf_hash = response.hash;
                    if (response.status == 'ok') {
                        $.growl.notice({ title: '', message: response.message, location: 'tc' });
                        if (response.hasOwnProperty('redirect')) {
                            setTimeout(function(){ window.location.href =  response.redirect;}, 3000);
                        }
                    }else{
                        $.growl.error({ title: '', message: response.message, location: 'tc' });
                        if (response.hasOwnProperty('html')) {
                            $('.site-otp').animate({opacity: '0'}, 150, function(){
                                $('.site-otp').animate({height: '0px'}, 150, function(){
                                    $('.site-otp').remove();
                                    $('.account-content').html(response.html);
                                });
                            });
                        }
                    }
                }).fail(function( jqXHR, textStatus ) {
                    $.growl.error({ title: '', message: $app.spec.getLang('error_connection'), location: 'tc' });
                });
            }
        },
        resendOtp: function() {
            $.ajax({
                url: backSet.base_url+'ajax/resend_login_otp',
                method: "POST",
                data: {[backSet.csrf_hash_name]: backSet.csrf_hash},
            }).done(function(response) {
                backSet.csrf_hash = response.hash;
                $.growl.notice({ title: '', message: response.message, location: 'tc' });
            }).fail(function( jqXHR, textStatus ) {
                $.growl.error({ title: '', message: $app.spec.getLang('error_connection'), location: 'tc' });
            });
        }
    }

    $app.spec = {
        adjust: function() {
            var adjustStatus = $app.utils.getCookie('adjust');
            if (adjustStatus == 'dark') {
                $("#darkcss").remove();
                $app.utils.setCookie('adjust', 'light', 365);
            }else{
                $('head').append(`<link rel="stylesheet" href="${backSet.base_url}assets/css/dark.css" id="darkcss" type="text/css" />`);
                $app.utils.setCookie('adjust', 'dark', 365);
            }
        },
        setLang: function(lang) {
            if (backSet.languages.hasOwnProperty(lang)) {
                $app.utils.setCookie('language', lang, 365);
                location.reload();
            }else{
                $.growl.error({ title: '', message: $app.spec.getLang('language_not_exists'), location: 'tc' });
            }
        },
        getLang: function(key) {
            if (backSet.language.hasOwnProperty(key)) {
                return backSet.language[key];
            }else{
                return key;
            }
        }
    }

    $app.utils = {
        setCookie: function(name,value,days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days*24*60*60*1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "")  + expires + "; path=/";
        },
        getCookie: function(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0;i < ca.length;i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        },
        toUniversalString: function(s, opt) {
            s = String(s);
            opt = Object(opt);

            var defaults = {
                'delimiter': ' ',
                'limit': undefined,
                'lowercase': true,
                'nonAlpha': false,
                'replacements': {},
                'transliterate': (typeof(XRegExp) === 'undefined') ? true : false
            };

            for (var k in defaults) {
                if (!opt.hasOwnProperty(k)) {
                    opt[k] = defaults[k];
                }
            }

            var char_map = {
                // Latin
                'À': 'A', 'Á': 'A', 'Â': 'A', 'Ã': 'A', 'Ä': 'A', 'Å': 'A', 'Æ': 'AE', 'Ç': 'C', 
                'È': 'E', 'É': 'E', 'Ê': 'E', 'Ë': 'E', 'Ì': 'I', 'Í': 'I', 'Î': 'I', 'Ï': 'I', 
                'Ð': 'D', 'Ñ': 'N', 'Ò': 'O', 'Ó': 'O', 'Ô': 'O', 'Õ': 'O', 'Ö': 'O', 'Ő': 'O', 
                'Ø': 'O', 'Ù': 'U', 'Ú': 'U', 'Û': 'U', 'Ü': 'U', 'Ű': 'U', 'Ý': 'Y', 'Þ': 'TH', 
                'ß': 'ss', 
                'à': 'a', 'á': 'a', 'â': 'a', 'ã': 'a', 'ä': 'a', 'å': 'a', 'æ': 'ae', 'ç': 'c', 
                'è': 'e', 'é': 'e', 'ê': 'e', 'ë': 'e', 'ì': 'i', 'í': 'i', 'î': 'i', 'ï': 'i', 
                'ð': 'd', 'ñ': 'n', 'ò': 'o', 'ó': 'o', 'ô': 'o', 'õ': 'o', 'ö': 'o', 'ő': 'o', 
                'ø': 'o', 'ù': 'u', 'ú': 'u', 'û': 'u', 'ü': 'u', 'ű': 'u', 'ý': 'y', 'þ': 'th', 
                'ÿ': 'y',
        
                // Latin symbols
                '©': '(c)',

                // Greek
                'Α': 'A', 'Β': 'B', 'Γ': 'G', 'Δ': 'D', 'Ε': 'E', 'Ζ': 'Z', 'Η': 'H', 'Θ': '8',
                'Ι': 'I', 'Κ': 'K', 'Λ': 'L', 'Μ': 'M', 'Ν': 'N', 'Ξ': '3', 'Ο': 'O', 'Π': 'P',
                'Ρ': 'R', 'Σ': 'S', 'Τ': 'T', 'Υ': 'Y', 'Φ': 'F', 'Χ': 'X', 'Ψ': 'PS', 'Ω': 'W',
                'Ά': 'A', 'Έ': 'E', 'Ί': 'I', 'Ό': 'O', 'Ύ': 'Y', 'Ή': 'H', 'Ώ': 'W', 'Ϊ': 'I',
                'Ϋ': 'Y',
                'α': 'a', 'β': 'b', 'γ': 'g', 'δ': 'd', 'ε': 'e', 'ζ': 'z', 'η': 'h', 'θ': '8',
                'ι': 'i', 'κ': 'k', 'λ': 'l', 'μ': 'm', 'ν': 'n', 'ξ': '3', 'ο': 'o', 'π': 'p',
                'ρ': 'r', 'σ': 's', 'τ': 't', 'υ': 'y', 'φ': 'f', 'χ': 'x', 'ψ': 'ps', 'ω': 'w',
                'ά': 'a', 'έ': 'e', 'ί': 'i', 'ό': 'o', 'ύ': 'y', 'ή': 'h', 'ώ': 'w', 'ς': 's',
                'ϊ': 'i', 'ΰ': 'y', 'ϋ': 'y', 'ΐ': 'i',

                // Turkish
                'Ş': 'S', 'İ': 'I', 'Ç': 'C', 'Ü': 'U', 'Ö': 'O', 'Ğ': 'G',
                'ş': 's', 'ı': 'i', 'ç': 'c', 'ü': 'u', 'ö': 'o', 'ğ': 'g', 

                // Russian
                'А': 'A', 'Б': 'B', 'В': 'V', 'Г': 'G', 'Д': 'D', 'Е': 'E', 'Ё': 'Yo', 'Ж': 'Zh',
                'З': 'Z', 'И': 'I', 'Й': 'Y', 'К': 'K', 'Л': 'L', 'М': 'M', 'Н': 'N', 'О': 'O',
                'П': 'P', 'Р': 'R', 'С': 'S', 'Т': 'T', 'У': 'U', 'Ф': 'F', 'Х': 'H', 'Ц': 'C',
                'Ч': 'Ch', 'Ш': 'Sh', 'Щ': 'Sh', 'Ъ': '', 'Ы': 'Y', 'Ь': '', 'Э': 'E', 'Ю': 'Yu',
                'Я': 'Ya',
                'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo', 'ж': 'zh',
                'з': 'z', 'и': 'i', 'й': 'y', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o',
                'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'c',
                'ч': 'ch', 'ш': 'sh', 'щ': 'sh', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu',
                'я': 'ya',

                // Ukrainian
                'Є': 'Ye', 'І': 'I', 'Ї': 'Yi', 'Ґ': 'G',
                'є': 'ye', 'і': 'i', 'ї': 'yi', 'ґ': 'g',

                // Czech
                'Č': 'C', 'Ď': 'D', 'Ě': 'E', 'Ň': 'N', 'Ř': 'R', 'Š': 'S', 'Ť': 'T', 'Ů': 'U', 
                'Ž': 'Z', 
                'č': 'c', 'ď': 'd', 'ě': 'e', 'ň': 'n', 'ř': 'r', 'š': 's', 'ť': 't', 'ů': 'u',
                'ž': 'z', 

                // Polish
                'Ą': 'A', 'Ć': 'C', 'Ę': 'e', 'Ł': 'L', 'Ń': 'N', 'Ó': 'o', 'Ś': 'S', 'Ź': 'Z', 
                'Ż': 'Z', 
                'ą': 'a', 'ć': 'c', 'ę': 'e', 'ł': 'l', 'ń': 'n', 'ó': 'o', 'ś': 's', 'ź': 'z',
                'ż': 'z',

                // Latvian
                'Ā': 'A', 'Č': 'C', 'Ē': 'E', 'Ģ': 'G', 'Ī': 'i', 'Ķ': 'k', 'Ļ': 'L', 'Ņ': 'N', 
                'Š': 'S', 'Ū': 'u', 'Ž': 'Z', 
                'ā': 'a', 'č': 'c', 'ē': 'e', 'ģ': 'g', 'ī': 'i', 'ķ': 'k', 'ļ': 'l', 'ņ': 'n',
                'š': 's', 'ū': 'u', 'ž': 'z',

                // Uzbek
                'Ў':'O', 'ў':'o\'', 'Ғ':'G\'', 'ғ':'g\'', 'Ҳ':'H', 'ҳ':'h', 'Қ':'Q', 'қ':'q',
                //Symbols
                '"': '\'', '–': '-', '‘': '\'', '“': '"', '”': '"', '’': '\'', '´': '\'',
            };

            for (var k in opt.replacements) {
                s = s.replace(RegExp(k, 'g'), opt.replacements[k]);
            }

            // Transliterate characters to ASCII
            if (opt.transliterate) {
                for (var k in char_map) {
                    s = s.replace(RegExp(k, 'g'), char_map[k]);
                }
            }

            // Replace non-alphanumeric characters with our delimiter
            if (opt.nonAlpha) {
                var nonRegex = '[^a-z0-9:\{\}+-.\'"\"/]+';
            }else{
                var nonRegex = '[^a-z0-9]+';
            }
            var alnum = (typeof(XRegExp) === 'undefined') ? RegExp(nonRegex, 'ig') : XRegExp('[^\\p{L}\\p{N}]+', 'ig');
            s = s.replace(alnum, opt.delimiter);

            // Remove duplicate delimiters
            s = s.replace(RegExp('[' + opt.delimiter + ']{2,}', 'g'), opt.delimiter);

            // Truncate slug to max. characters
            s = s.substring(0, opt.limit);

            // Remove delimiter from ends
            s = s.replace(RegExp('(^' + opt.delimiter + '|' + opt.delimiter + '$)', 'g'), '');

            return opt.lowercase ? s.toLowerCase() : s;
        }
    }

    $app.loader = {
        jquery: function() {
            $(".phone-mask").mask($app.spec.getLang('phone_format'));
            $(".otp-mask").mask($app.spec.getLang('otp_format')); 
        }
    }

    $app.table = {
        generateDatableSettings: function(elem) {
            var tableset = {};
            tableset['language'] = {
                "decimal":        $app.spec.getLang('datatable_decimal'),
                "emptyTable":     $app.spec.getLang('datatable_emptyTable'),
                "info":           $app.spec.getLang('datatable_info'),
                "infoEmpty":      $app.spec.getLang('datatable_infoEmpty'),
                "infoFiltered":   $app.spec.getLang('datatable_infoFiltered'),
                "infoPostFix":    $app.spec.getLang('datatable_infoPostFix'),
                "thousands":      $app.spec.getLang('datatable_thousands'),
                "lengthMenu":     $app.spec.getLang('datatable_lengthMenu'),
                "loadingRecords": $app.spec.getLang('datatable_loadingRecords'),
                "processing":     $app.spec.getLang('datatable_processing'),
                "search":         $app.spec.getLang('datatable_search'),
                "searchPlaceholder": $app.spec.getLang('datatable_searchPlaceholder'),
                "zeroRecords":    $app.spec.getLang('datatable_zeroRecords'),
                "paginate": {
                    "first":      $app.spec.getLang('datatable_first'),
                    "last":       $app.spec.getLang('datatable_last'),
                    "next":       $app.spec.getLang('datatable_next'),
                    "previous":   $app.spec.getLang('datatable_previous')
                },
                "aria": {
                    "sortAscending":  $app.spec.getLang('datatable_sortAscending'),
                    "sortDescending": $app.spec.getLang('datatable_sortDescending')
                },
                "buttons": {
                    "copyTitle": $app.spec.getLang('datatable_buttons_copyTitle'),
                    "copySuccess": {
                        _: $app.spec.getLang('datatable_buttons_copySuccess_d'),
                        1: $app.spec.getLang('datatable_buttons_copySuccess_1')
                    },
                    "pageLength": {
                        _: $app.spec.getLang('datatable_buttons_pageLength_d'),
                        '-1': $app.spec.getLang('datatable_buttons_pageLength_all'),
                    }
                }
            }

            var datatableButtons = elem.attr('datatable-buttons');
            var datatableButtonsDom = elem.attr('datatable-buttons-dom');
            var datatableProcessing = elem.attr('datatable-processing');
            var datatableServerSide = elem.attr('datatable-serverside');
            var datatableserverMethod = elem.attr('datatable-servermethod');
            var datatableAjax = elem.attr('datatable-ajax');
            var datatableColumns = elem.attr('datatable-columns');
            var datatableColumnDefs = elem.attr('datatable-columndefs');
            var datatableOrder = elem.attr('datatable-order');
            var datatableResponsive = elem.attr('datatable-responsive');
            var datatablelengthMenu = elem.attr('datatable-lengthmenu');
            var datatablefnRowCallback = elem.attr('datatable-fnrowcallback');

            if (typeof datatableProcessing !== "undefined") {
                tableset.processing = (datatableProcessing == '1') ? true : false;
            }

            if (typeof datatableServerSide !== "undefined") {
                tableset.serverSide = (datatableServerSide == '1') ? true : false;
            }

            if (typeof datatableResponsive !== "undefined") {
                tableset.responsive = (datatableResponsive == '1') ? true : false;
            }

            if (typeof datatablefnRowCallback !== "undefined") {
                datatablefnRowCallback = $.parseJSON(datatablefnRowCallback);
                tableset.fnRowCallback = new Function(datatablefnRowCallback['arguments'], datatablefnRowCallback['body']);
            }

            if (typeof datatableserverMethod !== "undefined") {
                tableset.serverMethod = datatableserverMethod;
            }

            if (typeof datatableAjax !== "undefined") {
                datatableAjax = $.parseJSON(datatableAjax);
                datatableAjax.headers = {
                    [backSet.csrf_hash_name]: backSet.csrf_hash
                };
                datatableAjax.data = function ( d ) {
                    d[backSet.csrf_hash_name] = backSet.csrf_hash;
                };
                datatableAjax.error = function ( d ) {
                    console.log(d.responseText);
                };
                datatableAjax.complete = function(response) {
                    var data  = $.parseJSON(response.responseText);
                    console.log(response.responseText);
                    backSet.csrf_hash = data['hash_token'];
                }
                tableset.ajax = datatableAjax;
            }

            if (typeof datatableColumns !== "undefined") {
                tableset.columns = $.parseJSON(datatableColumns);
            }

            if (typeof datatablelengthMenu !== "undefined") {
                tableset.lengthMenu = $.parseJSON(datatablelengthMenu);
            }

            if (typeof datatableOrder !== "undefined") {
                tableset.order = $.parseJSON(datatableOrder);
            }

            if (typeof datatableColumnDefs !== "undefined") {
                tableset.columnDefs = $.parseJSON(datatableColumnDefs);
            }

            if (typeof datatableButtonsDom === "undefined") {
                datatableButtonsDom = "Bfrtip";
            }

            if (typeof datatableButtons !== "undefined") {
                datatableButtons = $.parseJSON(datatableButtons);
                if (datatableButtons.length > 0) {
                    tableset.dom = datatableButtonsDom;
                    tableset.buttons = new Object([]);
                    $.each(datatableButtons, function(i, item) {
                        if (typeof item === 'string') {
                            tableset.buttons.push(item); 
                        }
                        if (typeof item === 'object') {
                           let button = {};
                            if ('text' in item) { button.text = item['text'];}
                            if ('className' in item) { button.className = item['className'];}
                            if ('extend' in item) {button.extend = item['extend'];}
                            if ('buttons' in item) {
                                $.each(item['buttons'], function(bi, bitem) {
                                    if ('customize' in bitem) {
                                        item['buttons'][bi]['customize'] = new Function(bitem['customize']['arguments'], bitem['customize']['body']);
                                    }
                                    if ('action' in bitem) {
                                        item['buttons'][bi]['action'] = new Function(bitem['action']['arguments'], bitem['action']['body']);
                                    }
                                });
                                button.buttons = item['buttons'];
                            }
                            if ('action' in item) { 
                                button.action = new Function(item['action']['arguments'], item['action']['body']);
                            }
                            tableset.buttons.push(button); 
                        }
                        
                    });
                    $.extend({}, tableset.buttons);
                }
            }
            return tableset;
        }
    }

    $(document).on("submit", ".site-auth", function (event) {
        event.preventDefault();
        $app.form.login($('.site-auth [name=mobilephone]').val());
    });

    $(document).on("submit", ".site-otp", function (event) {
        event.preventDefault();
        $app.form.loginOtp($('.site-otp [name=otp]').val());
    });

    $(document).on("click", ".login-set-adjust", function (event) {
        event.preventDefault();
        $app.spec.adjust();
        this.blur();
    });

    $(document).on("click", "[set-lang]", function (event) {
        event.preventDefault();
        $app.spec.setLang($('[set-lang]').attr('set-lang'));
        this.blur();
    });

    $(document).on("click", ".otp-resend", function (event) {
        event.preventDefault();
        $app.form.resendOtp();
        this.blur();
    });

    if ( $( "[datatable]" ).length ) {
        $( "[datatable]" ).each(function( index ) {
            var table = $( this );
            var name = table.attr( 'datatable' );
            $dtables[name] = $('[datatable='+name+']').DataTable($app.table.generateDatableSettings(table));
        });
    }
    
    var autoLogoutTimer;
    resetTimer();
    $(document).on('mouseover mousedown touchstart click keydown mousewheel DDMouseScroll wheel scroll',document,function(e){
        resetTimer();
    });
    function resetTimer(){ 
        if (window.location.href != backSet.base_url+'login') {
            clearTimeout(autoLogoutTimer)
            autoLogoutTimer = setTimeout(function() {
                window.location.href = backSet.base_url+'logout'; 
            }, 1800000);
        }
    } 

    $app.loader.jquery();
})(jQuery)