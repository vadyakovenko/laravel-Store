$('body').on('change', 'select[name="size"]', function(e){
    data = {
        'sizeId' : $(this).attr('id'),
        'storeSizeId' : $(this).val(),
    }

    var select = this;

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/admin-panel/products/setsize',
        type:'POST',
        data: data,
        success: function(res) {
            if(res.success) {
               select.outerHTML = res.value;
            }
        },
        error: function(res) {
            console.error(res);
        }
    });
});

