@extends('admin.layouts.app')

@section('content')
<div class="box">
        <div class="box-header">
            <h3 class="box-title">Товары ({{ $products->total() }})</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
            <a href=" " class="btn btn-success"><i class="fa fa-plus"></i> Добавить</a>
            </div>
            <form action='' method="GET">
                <div class="form-group row">
                    <div class="col-sm-1"><label for="inputEmail3" class="control-label">ID</label></div>       
                    <div class="col-sm-1">
                        <input type="text" name="name" class="form-control" id="inputEmail3">
                    </div>
                    <div class="col-sm-1"><label for="inputEmail3" class="control-label">Название</label></div>       
                    <div class="col-sm-4">
                        <input type="text" name="url" class="form-control" id="inputEmail3">
                    </div>
                    <div class="col-sm-1"><label for="inputEmail3" class="control-label">Категория</label></div>       
                    <div class="col-sm-4">
                        <input type="text" name="url" class="form-control" id="inputEmail3">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-1"><label for="inputEmail3" class="control-label">Активне</label></div>       
                    <div class="col-sm-1">
                        <input type="text" name="name" class="form-control" id="inputEmail3">
                    </div>
                    <div class="col-sm-1"><label for="inputEmail3" class="control-label">Поставщик</label></div>       
                    <div class="col-sm-4">
                        <input type="text" name="url" class="form-control" id="inputEmail3">
                    </div>
                    <div class="col-sm-1"><label for="inputEmail3" class="control-label">Код</label></div>       
                    <div class="col-sm-4">
                        <input type="text" name="url" class="form-control" id="inputEmail3">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                            <button class="btn btn-primary pull-right" type="submit"><i class="fa fa-filter"></i> Применить</button>
                    </div>
                </div>
                <hr>
            </form>
            @foreach($products as $product)
                <div class="box box-default">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h3><strong>Информация о товаре:</strong></h3>
                                <p>ID: <strong>{{ $product->id }}</strong></p>
                                <p>Название: <strong>{{ $product->name }}</strong></p>
                                <p>Артикул: <strong>{{ $product->code }}</strong></p>
                                <p>Поставщик: <strong>{{ $product->provider->name }}</strong></p>
                                <p>Категория: <strong>{{ $product->category ? $product->category->name : '-' }}</strong></p>                          
                                
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Варианты:</h4>
                            </div>
                        </div>
                        @foreach($product->variants as $variant)
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{ $variant->mainPhoto->path }}"  class="img-small img-thumbnail">
                                </div>
                                <div class="col-md-2">
                                    <h5><strong>Информация</strong></h5>
                                    <p>Артикул: <strong>{{ $variant->code }}</strong></p>
                                    <p>Цена: <strong>{{ $variant->price }} грн</strong></p>
                                </div>
                                <div class="col-md-3">
                                    <h5><strong>Цвет</strong></h5>
                                    <p>В магазине:
                                        @if($variant->color)
                                            <strong>{{ $variant->color->name }}</strong>
                                            <span class="label" style="background:{{ $variant->color->value }};border-radius:50%;border:1px solid #000">&nbsp;&nbsp;&nbsp;</span>
                                        @else
                                            -
                                        @endif
                                    </p>
                                    <p>При парсинге: <strong>{{ $variant->color_value }}</strong></p>
                                </div>
                                <div class="col-md-3">
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
                                                        @if($size->storeSize)
                                                            {{ $size->storeSize->value }}
                                                        @else
                                                            <select class="form-controll" name="size" id="{{ $size->id }}">
                                                                <option value="">-</option>
                                                                @foreach($storeSizes as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->value }}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    </td>
                                                    <td>{{ $size->parser_value }}</td>
                                                    <td>{{ $size->quantity }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-2">
                                    <h5><strong>Действия</strong></h5>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> Публикация
                                        </label>
                                    </div>
                                    <p><a href="{{$variant->original_url}}">Источник <i class="fa fa-external-link-square"></i></a></p>
                                    <p><a href="#">Сылка на товар <i class="fa fa-external-link-square"></i></a></p>                                    
                                    <p><a href="#" class=""><i class="fa fa-pencil"></i> Редактировать</a></p> 


                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            {{ $products->render() }} 
        </div> 
        <!-- /.box-body -->
    </div>
@endsection

@section('js')
    <script src="/admin/js/products.js"></script>
@endsection