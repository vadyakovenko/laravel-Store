@extends('admin.layouts.app')

@section('content')
<div class="box">
        <div class="box-header">
          <h3 class="box-title">Категории</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <a href="{{route('admin.category.create')}}" class="btn btn-success">Добавить</a>
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
                            <td><strong>{!!str_repeat('&#8212', $category->depth)!!} <a href="{{route('admin.category.show', $category)}}" >{{$category->name}}</a></strong></td>
                    @else
                        <tr>
                            <td>{!!str_repeat('&#8212', $category->depth)!!} <a href="{{route('admin.category.show', $category)}}" >{{$category->name}}</a></td>
                    @endif
                            <td>{{$category->slug}}</td>
                                @if($category->is_active)
                                    <td><span class="label bg-green">active</span></td>
                                @else
                                    <td><span class="label bg-red">draft</span></td>
                                @endif
                            <td>
                                <a href="{{route('admin.category.edit', $category)}}" class="fa fa-pencil"></a> 
                                <form class="inline-block" method="POST" action="{{route('admin.category.destroy', $category)}}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onclick="return confirm('Удаление родительской категории влечет за собой удаление всех дочерних категорий! Действительно удалить?')" class="delete-btn"><i class="fa fa-remove"></i></button>
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