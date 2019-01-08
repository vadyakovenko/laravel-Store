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
        url: '/admin-panel/ajax/product/setsize',
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
        url: '/admin-panel/ajax/product/setcolor',
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

$('body').on('submit', '#add-color', function(e) {
    e.preventDefault();
    var $name = $(this).find('input[name="name"]'),
        $value = $(this).find('input[name="value"]'),
        data = {},
        errors = {},
        url = $(this).attr('action');

    if( $name.val() !== '') {
        data.name = $name.val();   
    } else {
        errors.name = 'Укажите название!';
    }

    if( $value.val() !== '') {
        data.value = $value.val();   
    } else {
        errors.value = 'Укажите значение!';
    }

    if( Object.keys(errors).length > 0 ){
        var message = '';
        for(var key in errors){
            message += '<p>' + errors[key] + '</p>';
        }
        var $alert =  $(this).find('.alert-danger');
        $alert.html(message);
        $alert.removeClass('hidden');
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        type:'POST',
        data: data,
        success: function(res) {
            var variantId = $('#colors .color-box').data('variant');
            var html = '<div class="col-md-4 color-box" data-variant="' + variantId + '" data-id="' + res.id + '"><p><span class="label" style="background:' + res.value + ';border-radius:35%">&nbsp;&nbsp;&nbsp;</span><strong> ' + res.name + '</strong></p></div>';
            $('#colors .modal-body .row').append(html);
            $('#create-color').modal('hide');
        },
        error: function(res) {
            var message = '',
                errors = $.parseJSON(res.responseText).errors;

            if(errors.name) {
                message += '<p>' + errors.name[0] + '</p>'; 
            }

            if(errors.value) {
                message += '<p>' + errors.value[0] + '</p>'; 
            }

            var $alert =  $('#add-color .alert-danger');
            $alert.html(message);
            $alert.removeClass('hidden');
        }
    });   
});
