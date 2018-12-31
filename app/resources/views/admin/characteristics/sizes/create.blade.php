@extends('admin.layouts.app')

@section('breadcrumbs')
    {{-- {{ Breadcrumbs::render('admin.tags.create') }} --}}
@endsection

@section('content')
    <div class="box">
        <form method="POST" action="{{route('admin.characteristics.sizes.store')}}">
            @csrf
            <div class="box-header with-border">
                <h3 class="box-title">Добавить размер</h3>
            </div>
            <div class="box-body">
                <div class="col-md-4">
                    <div class="form-group {{!$errors->has('value') ? : 'has-error'}}">
                        <label for="name">Значение*:</label>
                        <input type="text" class="form-control" id="name" name="value" value="{{old('value')}}" placeholder="Название">
                        <span class="help-block">{{$errors->first('value')}}</span>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href={{route('admin.characteristics.sizes.index')}} class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Назад</a>
                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>
            </div>
            <!-- /.box-footer-->
        </form>
    </div>
@endsection
