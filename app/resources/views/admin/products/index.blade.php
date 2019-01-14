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
            <a class="btn btn-primary"  data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-controls="collapse1">
                    <i class="fa fa-filter"></i> Фильтры
              </a>
            </div>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-primary">
                    <div id="collapse1" class="panel-collapse collapse {{ count($requestData) ? 'in' : ''}} box-body" role="tabpanel" aria-labelledby="heading1">
                        <form action='' method="GET"> 
                            <div class="row">
                                <div class="col-md-1"><label for="inputEmail3" class="control-label pull-right">Категории</label></div>  
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <select class="form-control select2 hidden" name="categories[]" multiple="multiple" style="width:100%" data-placeholder="Категории" tabindex="-1" aria-hidden="true">
                                            <option value="">-</option>
                                            @foreach($categories as $category)
                                                <option {{ array_key_exists('categories', $requestData) ? in_array($category->id, $requestData['categories']) ? 'selected' : '' : '' }} value="{{$category->id}}">{{ $category->path()}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>   
                                <div class="col-md-1"><label for="inputEmail3" class="control-label pull-right">Поставщики</label></div> 
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <select class="form-control select2 hidden" name="providers[]" multiple="multiple" style="width:100%" data-placeholder="Поставщики" tabindex="-1" aria-hidden="true">
                                            <option value="">-</option>
                                            @foreach($providers as $provider)
                                                <option {{ array_key_exists('providers', $requestData) ? in_array($provider->id, $requestData['providers']) ? 'selected' : '' : ''}} value="{{$provider->id}}">{{ $provider->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1"><label for="inputEmail3" class="control-label pull-right">Название</label></div>       
                                <div class="col-md-2">
                                    <input type="text" name="name" value="{{ array_key_exists('name', $requestData) ? $requestData['name'] : '' }}" class="form-control input-sm" id="inputEmail3">
                                </div>
                                <div class="col-md-1"><label for="inputEmail3" class="control-label pull-right">Артикул</label></div>       
                                <div class="col-md-1">
                                    <input type="text" name="code" value="{{ array_key_exists('code', $requestData) ? $requestData['code'] : '' }}" class="form-control input-sm" id="inputEmail3">
                                </div>
                                <div class="col-md-1"><label for="inputEmail3" class="control-label pull-right">Цвет</label></div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control select2 hidden" name="colors[]" multiple="multiple" style="width:100%" data-placeholder="Цвет" tabindex="-1" aria-hidden="true">
                                            <option value="">-</option>
                                            @foreach($colors as $color)
                                                <option {{ array_key_exists('colors', $requestData) ? in_array($color->id, $requestData['colors']) ? 'selected' : '' : '' }} value="{{ $color->id}}">{{ $color->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1"><label for="inputEmail3" class="control-label pull-right">Размер</label></div> 
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select class="form-control select2 hidden" name="sizes[]" multiple="multiple" style="width:100%" data-placeholder="Размер" tabindex="-1" aria-hidden="true">
                                            <option value="">-</option>
                                            @foreach($storeSizes as $size)
                                                <option {{ array_key_exists('sizes', $requestData) ? in_array($size->id, $requestData['sizes']) ? 'selected' : '' : '' }} value="{{$size->id}}">{{ $size->value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    <label for="without-category" class="control-label pull-right">Без категории</label>
                                    <input type="checkbox" {{ array_key_exists('without-category', $requestData) ? 'checked' : '' }} name="without-category" id="without-category" class="">
                                </div>
                                <div class="col-md-1">
                                    <label for="without-size" class="control-label pull-right">Без размера</label>
                                    <input type="checkbox" {{ array_key_exists('without-size', $requestData) ? 'checked' : '' }} name="without-size" id="without-size" class="">
                                </div>
                                <div class="col-md-1">
                                    <label for="without-color" class="control-label pull-right">Без цвета</label>
                                    <input type="checkbox" {{ array_key_exists('without-color', $requestData) ? 'checked' : '' }} name="without-color" id="without-color" class="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                        <button class="btn btn-primary pull-right" type="submit"><i class="fa fa-repeat"></i> Применить</button>
                                </div>
                            </div>
                        </form>                      
                    </div>
                </div>
            </div>
            {{ $products->render() }} 
            @foreach($products as $product)
                <div class="box box-default">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h3><strong>Информация о товаре:</strong></h3>
                                <p>ID: <strong>{{ $product->id }}</strong></p>
                                <p>Название: <strong>{{ $product->name }}</strong></p>
                                <p>Поставщик: <strong>{{ $product->provider->name }}</strong></p>
                                <p>Категория: <strong>{{ $product->category ? $product->category->path() : '-' }}</strong></p>                          
                                
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
                                <div class="col-md-2 col-sm-3">
                                    <img src="{{ $variant->mainPhoto->path }}"  class="img-thumbnail">
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
                                            <span class="label" style="background:{{ $variant->color->value }};border-radius:35%">&nbsp;&nbsp;&nbsp;</span>
                                        @else
                                           <button data-variant="{{ $variant->id }}" class="btn btn-xs btn-danger add-color" data-toggle="modal" data-target="#colors"><i class="fa fa-plus"></i> Добавить</button>
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

<div id="colors" class="modal fade" role="dialog">
    <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Цвета</h4>
        </div>
        <div class="modal-body">
                <div class="row">
                    @foreach($colors as $k=>$color)
                        <div class="col-md-4 color-box" data-variant="" data-id="{{ $color->id }}">
                            <p>
                                <span class="label" style="background:{{ $color->value }};border-radius:35%">&nbsp;&nbsp;&nbsp;</span>
                                <strong>{{ $color->name }}</strong>
                            </p>
                        </div>
                    @endforeach
                </div>           
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" data-toggle="modal" data-target="#create-color"><i class="fa fa-plus"></i> Добавить новый</button>
        </div>
        </div>
    
    </div>
</div>

<div id="create-color" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Добавить цвет</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <form id="add-color" action="{{route('admin.ajax.color.store')}}" method="POST">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Название*</label>
                            <input type="text" class="form-control" id="name" name="name" value="" placeholder="Название">       
                            <span class="help-block"></span>                        
                        </div>
                        <div class="form-group">
                            <label for="value" >Значение*:</label>
                            <input type="text" id="value" name='value' class="coloringpick" value="">
                            <span class="help-block"></span>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Сохранить</button>                           
                    </div>
                </form>
            </div>           
        </div>
    </div>

  </div>
</div>

@endsection

@section('styles')
    <link rel="stylesheet" href="http://www.tutsville.com/files/coloring_pick/assets/css/jquery.coloring-pick.min.css">
    <link rel="stylesheet" href="/admin/plugins/select2/select2.min.css">
@endsection

@section('js')
    <script src="/admin/js/colorpicker.js"></script>
    <script src="/admin/js/products.js"></script>
    <script src="/admin/plugins/select2/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.coloringpick').coloringPick();
            $('.select2').select2();
        });
    </script>
@endsection