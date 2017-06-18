(function($) {
    'use strict';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $('.panel-collapse label').on('click', function(e) {
        e.stopPropagation();
    })

    $(".btn-del").on('click', function(e) {
        e.stopPropagation();
        $("#confirm-yes").attr('data-url', $(this).attr('data-url'));
        $("#cc").html($(this).attr('data-url'));
        $('#modalSlideUp').modal('show')
        console.log();
    })

    $("#confirm-yes").on('click', function(e) {
        e.stopPropagation();
        $.ajax({
            url: $(this).attr('data-url'),
            type: 'DELETE',
            success: function(msg) {
                 $('#modalSlideUp').modal('hide');
                 $("#data-row-"+msg).hide();
            },
            error: function(data) {
                alert('Cannot delete the category');
            }
        });
    })


})(window.jQuery);
