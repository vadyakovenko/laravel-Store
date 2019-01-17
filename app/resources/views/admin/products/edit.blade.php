@extends('admin.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.products.edit', $product) }}
@endsection

@section('content')
<div class="box">
    <div class="box-body">
        <div class="box-body">
            <div class="row">
                <p>ID: <strong>{{ $product->id }}</strong> Поставщик: <strong>{{ $product->provider->name }}</strong></p>
                <div class="row">
                    <div class="col-md-1">
                        <label for="name">Название:</label>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group input-group-sm">
                            <input id="name" type="text" value="{{ $product->name }}" class="form-control">
                            <span class="input-group-btn">
                                <button id='save-name' data-product={{ $product->id }}  type="button" disabled class="btn btn-info btn-flat">Сохранить</button>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="category">Категория:</label>
                    </div>
                    <div class="col-md-5">
                        <select data-product="{{ $product->id }}" id="category" name='set-category' class="form-control input-sm">
                            <option value="">-</option>
                            @foreach($categories as $category)
                                <option {{ $product->category ? $product->category->id == $category->id ? 'selected' : '' : '' }} value="{{$category->id}}">{{ $category->path()}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>            
            </div>
        </div>
    </div>
</div>

@if($product->variants)
    <div class="box">
        <h4>&nbspВарианты:</h4>
        @foreach($product->variants as $k=>$variant)
    <div class="box">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="heading1" >
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{ $variant->id }}" aria-expanded="true" aria-controls="{{ $variant->id }}">
                                {{ $k+1 }}). Вариант: {{ $variant->code }} {{ $variant->color ? '(' . $variant->color->name .')' : '' }}
                            </a>
                        </h4>
                    </div>
                </div>
                <div class="panel panel-primary">
                <div id="{{ $variant->id }}" class="panel-collapse collapse box-body" role="tabpanel" aria-labelledby="heading{{$k}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <strong>Ссылка на оригинал:</strong> <a class="btn btn-primary btn-sm" target="_blank" href="{{ $variant->original_url }}"><i class="fa fa-external-link-square"></i></a>
                            </div>
                            <div class="col-md-12">
                                <h5><strong>Цена:</strong></h5>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="weigh-medium" for="price{{ $variant->id }}">В магазине:</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input id="price{{ $variant->id }}" name="price"  class="form-control input-sm text-large" value="{{ $variant->price }}" type="number">
                                    </div>
                                    <div class="col-md-1">грн</div>
                                    <div class="col-md-2">
                                        <button id="change-price" data-variant="{{ $variant->id }}" data-price="" class="btn btn-success btn-sm hidden"><i class="fa fa-save"></i></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="weigh-medium" for="#price">При парсинге:</label>
                                    </div>
                                    <div class="col-md-3">&nbsp&nbsp
                                        {{$variant->parser_price}} 
                                    </div>
                                    <div class="col-md-1">грн</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                    <h5><strong>Цвет:</strong></h5>
                                    <p>В магазине:
                                        @if($variant->color)
                                            <strong>{{ $variant->color->name }}</strong>
                                            <span class="label" style="background:{{ $variant->color->value }};border-radius:35%">&nbsp;&nbsp;&nbsp;</span>
                                            <button data-variant="{{ $variant->id }}" class="btn btn-xs btn-warning add-color" data-toggle="modal" data-target="#colors"><i class="fa  fa-pencil"></i> Изменить</button>
                                        @else
                                            <button data-variant="{{ $variant->id }}" class="btn btn-xs btn-danger add-color" data-toggle="modal" data-target="#colors"><i class="fa fa-plus"></i> Добавить</button>
                                        @endif
                                    </p>
                                    <p>При парсинге: <strong>{{ $variant->color_value }}</strong></p>
                                </div>
                                @if($variant->sizes->count())
                                <div class="col-md-12">
                                        <h5><strong>Размеры</strong></h5>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Магазин</th>
                                                    <th>Парсер</th>
                                                    <th>К-во</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($variant->sizes as $size)
                                                    <tr>
                                                        <td>
                                                            <select name="size" id="{{ $size->id }}">
                                                                <option value="">-</option>
                                                                @foreach($storeSizes as $item)
                                                                    <option {{ $size->size_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->value }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>{{ $size->parser_value }}</td>
                                                        <td>{{ $size->quantity }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif  
                            <div class="col-md-12">
                                <label for="description{{ $variant->id }}">Описание:</label>
                                <textarea name="description" id="description{{ $variant->id }}" class="form-control" name="" id=""  rows="6">
                                    {{ $variant->description }}
                                </textarea>
                                <button class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить изменения</button>
                            </div>                          
                        </div>
                        <div class="col-md-6">
                            <h5><strong>Фотографии</strong></h5>
                            @foreach($variant->photos as $photo)
                                <div class="col-md-4">
                                    <img src="{{ $photo->path }}"  class="img-thumbnail">
                                </div>
        
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
    </div>

@endif

@include('admin.products._color-modal')
@endsection

@section('js')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script src="/admin/js/product-edit.js"></script>
    <script>
        $('textarea').ckeditor();
    </script>


@endsection