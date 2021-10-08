/**
* Theme: Adminox Admin Template
* Author: Coderthemes
* Form wizard page
*/

$(function() {
    // Override defaults
    $.fn.stepy.defaults.legend = false;
    $.fn.stepy.defaults.transition = 'fade';
    $.fn.stepy.defaults.duration = 200;
    $.fn.stepy.defaults.backLabel = '<i class="mdi mdi-arrow-left-bold"></i> Back';
    $.fn.stepy.defaults.nextLabel = 'Next <i class="mdi mdi-arrow-right-bold"></i>';


    $('#default-wizard').stepy();

    // Clickable titles
    $("#wizard-clickable").stepy({
        titleClick: true
    });

    // Stepy callbacks
    $("#wizard-callbacks").stepy({
        next: function(index) {
            alert('Going to step: ' + index);
        },
        back: function(index) {
            alert('Returning to step: ' + index);
        },
        finish: function() {
            alert('Submit canceled.');
            return false;
        }
    });

    // Apply "Back" and "Next" button styling
    $('.stepy-navigator').find('.button-next').addClass('btn btn-primary waves-effect waves-light');
    $('.stepy-step').find('.button-back').addClass('btn btn-default waves-effect pull-left');
});