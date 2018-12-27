@extends('admin.layouts.app')

@section('content')
    <div class="box">
        <form action="{{route('admin.category.store')}}" method="POST">
            @csrf
            <div class="box-header with-border">
                <h3 class="box-title">Добавить категорию категорию</h3>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group {{!$errors->has('name') ? : 'has-error'}}">
                        <label for="name">Название*</label>
                        <input required type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="">
                        <span class="help-block">{{$errors->first('name')}}</span>
                    </div>
                    <div class="form-group {{!$errors->has('slug') ? : 'has-error'}}">
                        <label for="name">Slug*</label>
                        <input required type="text" class="form-control" id="name" name="slug" value="{{old('slug')}}" placeholder="">
                        <span class="help-block">{{$errors->first('slug')}}</span>
                    </div>
                    <div class="form-group {{!$errors->has('parent_id') ? : 'has-error'}}">
                        <label>Родительская категория</label>
                        <select name="parent_id" class="form-control">
                            <option value="">-</option>
                            @foreach($categories as $category)
                                <option {{old('parent_id') == $category->id ? 'selected' : ''}} value="{{$category->id}}">{!!str_repeat('&#8212', $category->depth)!!}{{$category->name}}</option>
                            @endforeach
                        </select>
                        <span class="help-block">{{$errors->first('name')}}</span>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input {{old('is_acive') ? 'checked':''}} name="is_active" type="checkbox"> Активировать
                        </label>
                    </div> 
                </div>
            </div>
            <div class="box-footer">
                <a href="{{route('admin.category.index')}}" class="btn btn-default">Назад</a>
                <button type="submit" class="btn btn-success pull-right">Добавить</button>
            </div>
        </form>
    </div>
@endsection