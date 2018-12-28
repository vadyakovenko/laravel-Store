@extends('admin.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.categories.show', $category) }}
@endsection


@section('content')
    <div class="box">
        <div class="box-body">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">            
                        <a href="{{route('admin.categories.index')}}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Назад</a>
                        <a href={{route('admin.categories.edit', $category)}} type="submit" class="btn btn-success"><i class="fa fa fa-pencil"></i> Изменить</a>
                        <form class="inline-block" method="POST" action="{{route('admin.categories.destroy', $category)}}">
                            @csrf
                            @method('delete')
                            <button type="submit" onclick="return confirm('Удаление родительской категории влечет за собой удаление всех дочерних категорий! Действительно удалить?')" class="btn btn-danger">Удалить</button>
                        </form>
                    </div>                   
                    <ul class="list-group">
                        <li class="list-group-item">Название категории: <strong>{{$category->name}}</strong></li>
                        <li class="list-group-item">Slug: <strong>{{$category->slug}}</strong></li>
                        <li class="list-group-item">Статус: <span class="label {{$category->is_active ? "bg-green" : "bg-red" }}">{{$category->is_active ? "active" : "draft" }}</span></li>
                        <li class="list-group-item">Количество товаров: <strong>0</strong></li>
                    </ul>
                </div>
            </div>
            {{-- <div class="col-md-3">
                <div class="thumbnail">
                    <img src="https://fakeimg.pl/420x320/ff0000,128/333333,255/?text=Sample&font=lobster" ">
                    <div class="caption">
                        <h4>Картинка категории</h4>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection