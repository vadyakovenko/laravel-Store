@extends('admin.layouts.app')

@section('breadcrumbs')
    {{-- {{ Breadcrumbs::render('admin.tags.create') }} --}}
@endsection

@section('content')
    <div class="box">
        <form method="POST" action="{{route('admin.characteristics.colors.store')}}">
            @csrf
            <div class="box-header with-border">
                <h3 class="box-title">Добавить цвет</h3>
            </div>
            <div class="box-body">
                <div class="col-md-4">
                    <div class="form-group {{!$errors->has('name') ? : 'has-error'}}">
                        <label for="name">Название*</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Название">
                        <span class="help-block">{{$errors->first('name')}}</span>
                    </div>
                    <div class="form-group {{ !$errors->has('value')?:'has-error' }}">
                        <label for="value" >Значение*:</label>
                        <span class="help-block">{{$errors->first('value')}}</span>
                        <input type="text" id="value" name='value' class="coloringpick" value="">
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href={{route('admin.characteristics.colors.index')}} class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Назад</a>
                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>
            </div>
            <!-- /.box-footer-->
        </form>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="http://www.tutsville.com/files/coloring_pick/assets/css/jquery.coloring-pick.min.css">
@endsection

@section('js')
    <script src="/admin/js/colorpicker.js"></script>
    <script>$('.coloringpick').coloringPick();</script>
@endsection
