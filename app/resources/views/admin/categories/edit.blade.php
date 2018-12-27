@extends('admin.layouts.app')

@section('content')
    <div class="box">
        <form action="{{route('admin.categories.update', $category)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="box-header with-border">
                <h3 class="box-title">Изменить категорию категорию <strong>{{$category->name}}</strong></h3>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group {{!$errors->has('name') ? : 'has-error'}}">
                        <label for="name">Название*</label>
                        <input required type="text" class="form-control" id="name" name="name" value="{{$category->name}}" placeholder="Название категории">
                        <span class="help-block">{{$errors->first('name')}}</span>
                    </div>
                    <div class="form-group {{!$errors->has('slug') ? : 'has-error'}}">
                        <label for="name">Slug*</label>
                        <input required type="text" class="form-control" id="name" name="slug" value="{{$category->slug}}" placeholder="Slug">
                        <span class="help-block">{{$errors->first('slug')}}</span>
                    </div>
                    <div class="form-group {{!$errors->has('parent_id') ? : 'has-error'}}">
                        <label>Родительская категория</label>
                        <select name="parent_id" class="form-control">
                            <option value="">---</option>
                            @foreach($categories as $item)
                                @if($item->id == $category->id) @continue @endif
                                <option {{$category->parent_id == $item->id ? 'selected' : ''}} {{old('parent_id') == $item->id ? 'checked' : ''}} value="{{$item->id}}">{!!str_repeat('&#8212', $item->depth)!!}{{$item->name}}</option>
                            @endforeach
                        </select>
                        <span class="help-block">{{$errors->first('name')}}</span>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input {{$category->is_active ? 'checked':''}} name="is_active" type="checkbox"> <strong>Активировать</strong>
                        </label>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="{{route('admin.categories.index')}}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Назад</a>
                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>
            </div>
        </form>
    </div>
@endsection