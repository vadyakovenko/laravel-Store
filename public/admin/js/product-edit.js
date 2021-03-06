$(document).ready(function(){
    $(window.location.hash).collapse('show');
});

$('textarea').ckeditor();
$('.coloringpick').coloringPick();

$('body').on('change', 'select[name="size"]', function(e){
    var data = {
        'sizeId' : $(this).attr('id'),
        'storeSizeId' : $(this).val(),
    },
    select = $(this);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/admin-panel/ajax/product/set/size',
        type:'POST',
        data: data,
        success: function(res) {
            if(res.success) {
               select.css('background', '#75ff75');
               setTimeout(function(){
                    select.css('background', '#fff');
                }, 2000);
            }
        },
        error: function(res) {
            alert('Произошла неизвестная ошибка! Обновите странице у попробуйте еще раз!');
            console.error(res);
        }
    });
});


$('body').on('click', '.add-color, .change-color', function(){
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
        url: '/admin-panel/ajax/product/set/color',
        type:'POST',
        data: data,
        success: function(res) {
            $('#colors').modal('hide');
            var html = '<strong>'+res.name+'</strong> <span class="label" style="background:'+res.value+';border-radius:35%">&nbsp;&nbsp;&nbsp;</span>';
            $('.add-color[data-variant="' + res.id + '"]').siblings('span.color-inform').html(html);
            $('.add-color[data-variant="' + res.id + '"]').addClass('hidden');
            $('.change-color[data-variant="' + res.id + '"]').removeClass('hidden');            
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

    deleteErrors();

    if( $name.val() !== '') {
        data.name = $name.val();   
    } else {
        $name.closest('.form-group').addClass('has-error');
        $name.next('span').text('Добавьте название!');
        return false;
    }

    if( $value.val() !== '') {
        data.value = $value.val();   
    } else {
        var $group = $value.closest('.form-group');
        $group.addClass('has-error');
        $group.find('.help-block').text('Укажите значение!');
        return false;
    }


    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        type:'POST',
        data: data,
        success: function(res) {
            var variantId = $('#colors .color-box').attr('data-variant');
            var html = '<div class="col-md-4 color-box" data-variant="' + variantId + '" data-id="' + res.id + '"><p><span class="label" style="background:' + res.value + ';border-radius:35%">&nbsp;&nbsp;&nbsp;</span><strong> ' + res.name + '</strong></p></div>';
            $('#colors .modal-body .row').append(html);
            $('#create-color').modal('hide');
            $name.val('');
        },
        error: function(res) {
            var errors = $.parseJSON(res.responseText).errors;

            if(errors.name) {
                $name.closest('.form-group').addClass('has-error');
                $name.next('span').text(errors.name[0]);
            }

            if(errors.value) {
                var $group = $value.closest('.form-group');
                $group.addClass('has-error');
                $group.find('.help-block').text(errors.value[0]);
            }
        }
    });   
});

$('body').on('change', 'select[name="set-category"]', function(){
    var data = {
        'productId':$(this).attr('data-product'),
        'categoryId':$(this).val(),
    },
    select = $(this);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/admin-panel/ajax/product/set/category',
        type:'POST',
        data: data,
        success: function(res) {
            if(res.success) {
                select.css('background', '#75ff75');
                setTimeout(function(){
                     select.css('background', '#fff');
                 }, 2000);
             }
        },
        error: function(res) {
            console.error(res);
        }
    });
    
});

$('#create-color').on('hidden.bs.modal', function() {
    deleteErrors();
});

function deleteErrors(){
    var $form = $('#add-color');
    $form.find('.form-group').removeClass('has-error');
    $form.find('span.help-block').text('');
}

$('#name').on('keypress', function(){
    $('#save-name').prop("disabled", false);
});

$('#name').on('change', function(){
    $('#save-name').prop("disabled", false);
});

$('body').on('click', '#save-name', function() {
    var data = {
        'productId':$(this).attr('data-product'),
        'name':$('#name').val(),
    };

    $('#save-name').text('Сохранение');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/admin-panel/ajax/product/update/name',
        type:'POST',
        data: data,
        success: function(res) {
            $('#save-name').attr('disabled', 'disabled');
            $('#save-name').text('Сохранено');
            setTimeout(function(){
                $('#save-name').text('Сохранить');
            }, 2500);
        },
        error: function(res) {
            $('#save-name').text('Сохранить');
            alert('Произошла неизвестная ошибка! Обновите странице у попробуйте еще раз!');
            console.error(res);
        }
    });
});

$('input[name="price"]').on('keypress', function(){
    var $button = $(this).closest('.row').find('#change-price');
    $button.removeClass('hidden');
    $button.attr('data-price', $(this).val());
});

$('input[name="price"]').on('change', function(){
    var $button = $(this).closest('.row').find('#change-price');
    $button.removeClass('hidden');
    $button.attr('data-price', $(this).val());
});

$('body').on('click', '#change-price', function() {
    var data = {
        'variantId':$(this).attr('data-variant'),
        'price':+$(this).attr('data-price'),
    },
    $button = $(this);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/admin-panel/ajax/product/update/price',
        type:'POST',
        data: data,
        success: function(res) {
            $button.addClass('hidden');
        },
        error: function(res) {
            alert('Произошла неизвестная ошибка! Обновите странице у попробуйте еще раз!');
            console.error(res);
        }
    });
});

for (var i in CKEDITOR.instances) {
    CKEDITOR.instances[i].on('change', function() {
        var $button = $('#' + $(this).attr('name')).siblings('button');
        $button.removeClass('hidden');
        $button.attr('data-description', $('#' + $(this).attr('name')).val());
        
    });
}


$('body').on('click', '#change-description', function() {
    var data = {
        'variantId':$(this).attr('data-variant'),
        'description':$(this).attr('data-description'),
    },    
    $button = $(this);
    snowing
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/admin-panel/ajax/product/update/description',
        type:'POST',
        data: data,
        success: function(res) {
            $button.addClass('hidden');
        },
        error: function(res) {
           // $('#save-name').text('Сохранить');
            alert('Произошла неизвестная ошибка! Обновите странице у попробуйте еще раз!');
            console.error(res);
        }
    });
});