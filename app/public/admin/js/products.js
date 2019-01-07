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


$('body').on('click', '.add-color', function(){
    $('#colors .color-box').attr('data-variant', $(this).data('variant'));
});

$('body').on('click', '.color-box', function(){
    var data = {
        'variantId' : $(this).attr('data-variant'),
        'colorId' : $(this).data('id')
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/admin-panel/products/setcolor',
        type:'POST',
        data: data,
        success: function(res) {
            $('#colors').modal('hide');
            var html = '<strong>'+res.name+'</strong> <span class="label" style="background:'+res.value+';border-radius:35%">&nbsp;&nbsp;&nbsp;</span>';
            $('.add-color[data-variant="' + res.id + '"]')[0].outerHTML = html;
        },
        error: function(res) {
            console.error(res);
        }
    });
});
