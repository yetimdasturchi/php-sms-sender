/**
 * Theme: Adminox Admin Template
 * Author: Coderthemes
 * Form Advanced
 */


jQuery(document).ready(function () {

    // Select2
    $(".select2").select2();

    $(".select2-limiting").select2({
        maximumSelectionLength: 2
    });

    $('.selectpicker').selectpicker();
    $(":file").filestyle({input: false});
});

//Bootstrap-TouchSpin
$("input[name='demo1']").TouchSpin({
    min: 0,
    max: 100,
    step: 0.1,
    decimals: 2,
    boostat: 5,
    maxboostedstep: 10,
    postfix: '%',
    buttondown_class: 'btn btn-primary',
    buttonup_class: 'btn btn-primary'
});
$("input[name='demo2']").TouchSpin({
    min: -1000000000,
    max: 1000000000,
    stepinterval: 50,
    maxboostedstep: 10000000,
    prefix: '$',
    buttondown_class: 'btn btn-primary',
    buttonup_class: 'btn btn-primary'
});
$("input[name='demo3']").TouchSpin({
    buttondown_class: 'btn btn-primary',
    buttonup_class: 'btn btn-primary'
});
$("input[name='demo3_21']").TouchSpin({
    initval: 40,
    buttondown_class: 'btn btn-primary',
    buttonup_class: 'btn btn-primary'
});
$("input[name='demo3_22']").TouchSpin({
    initval: 40,
    buttondown_class: 'btn btn-primary',
    buttonup_class: 'btn btn-primary'
});

$("input[name='demo5']").TouchSpin({
    prefix: "pre",
    postfix: "post",
    buttondown_class: 'btn btn-primary',
    buttonup_class: 'btn btn-primary'
});
$("input[name='demo0']").TouchSpin({
    buttondown_class: 'btn btn-primary',
    buttonup_class: 'btn btn-primary'
});


//Bootstrap-MaxLength
$('input#defaultconfig').maxlength()

$('input#thresholdconfig').maxlength({
    threshold: 20
});

$('input#moreoptions').maxlength({
    alwaysShow: true,
    warningClass: "label label-success",
    limitReachedClass: "label label-danger"
});

$('input#alloptions').maxlength({
    alwaysShow: true,
    warningClass: "label label-success",
    limitReachedClass: "label label-danger",
    separator: ' out of ',
    preText: 'You typed ',
    postText: ' chars available.',
    validate: true
});

$('textarea#textarea').maxlength({
    alwaysShow: true
});

$('input#placement').maxlength({
    alwaysShow: true,
    placement: 'top-left'
});