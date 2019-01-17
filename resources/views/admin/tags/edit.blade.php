@extends('admin.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.tags.edit', $tag) }}
@endsection

@section('content')
    <div class="box">
        <form method="POST" action="{{route('admin.tags.update', $tag)}}">
            @csrf
            @method('PUT')
            <div class="box-header with-border">
                <h3 class="box-title">Редактировать тег <strong>{{$tag->name}}</strong></h3>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group {{!$errors->has('name') ? : 'has-error'}}">
                        <label for="name">Название*</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$tag->name}}" placeholder="Название">
                        <span class="help-block">{{$errors->first('name')}}</span>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{route('admin.tags.index')}}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Назад</a>
                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>
            </div>
            <!-- /.box-footer-->
        </form>
    </div>
@endsection