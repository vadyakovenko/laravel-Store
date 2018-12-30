@extends('admin.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.categories.edit', $category) }}
@endsection

@section('content')
    <div class="box">
        <form action="{{route('admin.categories.update', $category)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="box-header with-border">
                <h3 class="box-title">Редактировать категорию <strong>{{$category->name}}</strong></h3>
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
                <div class="col-md-6">
                    <div class="form-group {{!$errors->has('seo_title') ? : 'has-error'}}">
                        <label for="seo_title">Title</label>
                        <input required type="text" class="form-control" id="seo_title" name="seo_title" value="{{$category->meta->title}}" placeholder="Title">
                        <span class="help-block">{{$errors->first('seo_title')}}</span>
                    </div>
                    <div class="form-group {{!$errors->has('seo_description') ? : 'has-error'}}">
                        <label for="seo_description">Description</label>
                        <textarea id="seo_description" name="seo_description" class="form-control" placeholder="Description">{{$category->meta->description}}</textarea>
                        <span class="help-block">{{$errors->first('seo_description')}}</span>
                    </div>
                    <div class="form-group {{!$errors->has('seo_keywords') ? : 'has-error'}}">
                        <label for="seo_keywords">Keywords</label>
                        <textarea id="seo_keywords" name="seo_keywords" class="form-control" placeholder="Keywords">{{$category->meta->keywords}}</textarea>
                        <span class="help-block">{{$errors->first('seo_keywords')}}</span>
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