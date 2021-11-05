$('.fa-star').click(function (e) {
    e.stopPropagation();
    $(this).toggleClass('fas far');

    var id = $(this).data('id');
    var type = $(this).data('type');

    $.ajax({
        url: '/toggleFav',
        type: 'POST',
        data: {
            id: id,
            type: type
        },
        success: function (data) {
            if (data.success) {
                if (data.isFav) {
                    $('.fa-star[data-id=' + id + '][data-type=' + type + ']').addClass('fas');
                    $('.fa-star[data-id=' + id + '][data-type=' + type + ']').removeClass('far');
                } else {
                    $('.fa-star[data-id=' + id + '][data-type=' + type + ']').addClass('far');
                    $('.fa-star[data-id=' + id + '][data-type=' + type + ']').removeClass('fas');
                }
            }
        }
    });
});