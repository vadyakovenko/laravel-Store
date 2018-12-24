@extends('admin.layouts.app')

@section('content')
<div class="box">
    <div class="box-header">
      <h3 class="box-title">Пользователи</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      {{-- <div class="form-group">
        <a href="create.html" class="btn btn-success">Добавить</a>
      </div> --}}
      <table id="example1" class="table table-bordered">
        <thead>
        <tr>
          <th>ID</th>
          <th>Имя</th>
          <th>Фамилия</th>
          <th>Email</th>
          <th>Роль</th>
          <th>Действия</th>
        </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="{{$user->status == $CurrentUser::STATUS_ACTIVE ? 'bg-success' : "bg-danger"}}">
                    <td>{{$user->id}}</td>
                    <td>{{$user->first_name}}</td>
                    <td>{{$user->last_name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role}}</td>
                    <td><a href="edit.html" class="fa fa-pencil"></a> <a href="#" class="fa fa-remove"></a></td>
                </tr>
            @endforeach
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
</div>
@endsection