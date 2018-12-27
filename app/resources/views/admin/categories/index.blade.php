@extends('admin.layouts.app')

@section('content')
<div class="box">
        <div class="box-header">
          <h3 class="box-title">Категории</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <a href="{{route('admin.categories.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Добавить</a>
          </div>
          <table class="table table-bordered">
            <thead>
                <tr>
                    <th>НАЗВАНИЕ</th>
                    <th>Slug</th>
                    <th>Состояние</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    @if(!$category->depth)
                        <tr class="active">
                            <td><strong>{!!str_repeat('&#8212', $category->depth)!!} <a href="{{route('admin.categories.show', $category)}}" >{{$category->name}}</a></strong></td>
                    @else
                        <tr>
                            <td>{!!str_repeat('&#8212', $category->depth)!!} <a href="{{route('admin.categories.show', $category)}}" >{{$category->name}}</a></td>
                    @endif
                            <td>{{$category->slug}}</td>
                                @if($category->is_active)
                                    <td><span class="label bg-green">active</span></td>
                                @else
                                    <td><span class="label bg-red">draft</span></td>
                                @endif
                            <td>
                                <a href="{{route('admin.categories.edit', $category)}}" title="Изменить категорию" class="fa fa-pencil"></a> 
                                <form class="inline-block" method="POST" action="{{route('admin.categories.destroy', $category)}}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" title="Удалить категорию" onclick="return confirm('Удаление родительской категории влечет за собой удаление всех дочерних категорий! Действительно удалить?')" class="delete-btn"><i class="fa fa-remove"></i></button>
                                </form>
                                <form class="inline-block" method="POST" action="{{route('admin.categories.first', $category)}}">
                                    @csrf
                                    <button type="submit" class="move-btn" title="Наверх уровня"><i class="fa fa-angle-double-up"></i></button>
                                </form>
                                <form class="inline-block" method="POST" action="{{route('admin.categories.up', $category)}}">
                                    @csrf
                                    <button type="submit" class="move-btn" title="На позицию вверх"><i class="fa fa-angle-up"></i></button>
                                </form>
                                <form class="inline-block" method="POST" action="{{route('admin.categories.down', $category)}}">
                                    @csrf
                                    <button type="submit" class="move-btn" title="На позицию вниз"><i class="fa fa-angle-down"></i></button>
                                </form>
                                <form class="inline-block" method="POST" action="{{route('admin.categories.last', $category)}}">
                                    @csrf
                                    <button type="submit" class="move-btn" title="Вниз уровня"><i class="fa fa-angle-double-down"></i></button>
                                </form>
                            </td>
                        </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
@endsection