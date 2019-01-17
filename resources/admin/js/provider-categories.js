$('body').on('change', 'select[name="categories"]', function() {
    if(!$(this).val()) {
        $(this).val($(this).attr('data-old'));
        return;
    }
    var elem = $(this),
        data = {
            'categoryId' : $(this).attr('data-category'),
            'storeCategoryId' : $(this).val(),
        };
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/admin-panel/ajax/providers/attachcategory ',
        type:'POST',
        data: data,
        success: function(res) {
            if(res.success) {
               elem.closest('tr').removeClass('danger').addClass('success');
               elem.attr('data-old', data.storeCategoryId);
            }
        },
        error: function(res) {
            console.error(res);
        }
    });
});
