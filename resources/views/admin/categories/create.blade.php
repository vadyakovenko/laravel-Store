@extends('admin.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.categories.create') }}
@endsection

@section('content')
    <div class="box">
        <form action="{{route('admin.categories.store')}}" method="POST">
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
                            <input {{old('is_acive') ? 'checked':''}} name="is_active" type="checkbox"><strong>Активировать</strong>
                        </label>
                    </div> 
                </div>
                <div class="col-md-6">
                    <div class="form-group {{!$errors->has('seo_title') ? : 'has-error'}}">
                        <label for="seo_title">Title</label>
                        <input type="text" class="form-control" id="seo_title" name="seo_title" value="{{ old('seo_title') }}" placeholder="Title">
                        <span class="help-block">{{$errors->first('seo_title')}}</span>
                    </div>
                    <div class="form-group {{!$errors->has('seo_description') ? : 'has-error'}}">
                        <label for="seo_description">Description</label>
                        <textarea id="seo_description", name="seo_description" class="form-control" placeholder="Description" >{{ old('seo_description')}}</textarea>
                        <span class="help-block">{{$errors->first('seo_description')}}</span>
                    </div>
                    <div class="form-group {{!$errors->has('seo_keywords') ? : 'has-error'}}">
                        <label for="seo_keywords">Keywords</label>
                        <textarea id="seo_keywords" name="seo_keywords" class="form-control" placeholder="Keywords" >{{ old('seo_keywords')}}</textarea>
                        <span class="help-block">{{$errors->first('seo_keywords')}}</span>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="{{route('admin.categories.index')}}" class="btn btn-default"><i class="fa  fa-arrow-circle-left"></i> Назад</a>
                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>
            </div>
        </form>
    </div>
@endsection