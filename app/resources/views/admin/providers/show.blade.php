@extends('admin.layouts.app')

@section('content')

<div class="box">
    <div class="box-body">
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">            
                <a href="{{route('admin.providers.index')}}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Назад</a>
                <a href={{route('admin.providers.edit', $provider)}} type="submit" class="btn btn-success"><i class="fa fa fa-pencil"></i> Изменить</a>
                <form class="inline-block" method="POST" action="{{route('admin.providers.destroy', $provider)}}">
                    @csrf
                    @method('delete')
                    <button type="submit" onclick="return confirm('Действительно удалить?')" class="btn btn-danger">Удалить</button>
                </form>
            </div>                   
            <ul class="list-group">
                <li class="list-group-item">Название: <strong>{{$provider->name}}</strong></li>
                <li class="list-group-item">Ссылка: <strong><a target="_blank" href="{{ $provider->url }}">{{ $provider->url }}</a></strong></li>
                <li class="list-group-item">Количество товаров: <strong>{{ $provider->products->count() }}</strong></li>
            </ul>
        </div>
    </div>
</div>
<div class="box">
    <div class="box-body">
        <div class="col-md-7">
                <div class="panel-heading"><strong>Условия</strong></div>
            <div class="panel panel-default">
                {{$provider->conditions}}
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel-heading"><strong>Коментарий</strong></div>
            <div class="panel panel-default">
                    {{$provider->comment}}
            </div>
        </div>
    </div>
</div>

<div class="box">
    <div class="box-body">
        <table class="table">
            <thead>
                <tr>
                    <th><strong>#</strong></th>
                    <th>Категория (парсер)</th>
                    <th>Категория (магазин)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($providerCategories as $k=>$category)
                    <tr class=" {{ $category->store_category_id ? 'success' : 'danger' }}">
                        <td>{{ $k+1 }}</td>

                        <td>{{ $category->tree() }}</td>
                        <td>
                            <select data-old="{{ $category->store_category_id }}" data-category="{{ $category->id }}" name="categories" class="form-control">
                                <option value="">---</option>
                                @foreach($storeCategories as $item)
                                    <option {{ $category->store_category_id == $item->id ? 'selected' : ''}} {{old('parent_id') == $item->id ? 'checked' : ''}} value="{{$item->id}}">{!!str_repeat('&#8212', $item->depth)!!}{{$item->name}}</option>
                                @endforeach
                            </select>
                        </td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('js')
    <script src="/admin/js/provider-categories.js" ></script>
@endsection