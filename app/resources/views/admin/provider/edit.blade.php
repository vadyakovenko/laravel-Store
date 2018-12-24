@extends('admin.layouts.app')

@section('content')
    <div class="box">
        <form method="POST" action="{{route('admin.provider.update', $provider)}}">
            @csrf
            @method('PUT')
            <div class="box-header with-border">
                <h3 class="box-title">Добавить поставщика</h3>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group {{!$errors->has('name') ? : 'has-error'}}">
                        <label for="name">Название*</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$provider->name}}" placeholder="Название">
                        <span class="help-block">{{$errors->first('name')}}</span>
                    </div>
                    <div class="form-group {{!$errors->has('url') ? : 'has-error'}}">
                        <label for="url">Ссылка на сайт*</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="Ссылка на сайт" value="{{$provider->url}}">
                        <span class="help-block">{{$errors->first('url')}}</span>
                    </div>
                    <div class="form-group">
                        <label for="conditions">Условия сотрудничества</label>
                        <textarea rows="5" name="conditions" id="conditions" class="form-control">{{$provider->conditions}}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{!$errors->has('email') ? : 'has-error'}}">
                        <label for="email">E-mail</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="email" value={{$provider->mail}}>
                        <span class="help-block">{{$errors->first('email')}}</span>
                    </div>
                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" value="{{$provider->phone}}" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="">
                        </div>
                    </div>
                    <div class="form-group {{!$errors->has('comment') ?: "has-error"}}">
                        <label for="exampleInputEmail1">Коментарий</label>
                        <textarea id="comment" name="comment" rows="5" class="form-control">{{$provider->comment}}</textarea>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{route('admin.provider.index')}}" class="btn btn-default">Назад</a>
                <button type="submit" class="btn btn-success pull-right">Изменить</button>
            </div>
            <!-- /.box-footer-->
        </form>
    </div>
@endsection

@section('js')
    <script src="/admin/plugins/input-mask/jquery.inputmask.js"></script>
    <script>$('[data-mask]').inputmask()</script>
@endsection