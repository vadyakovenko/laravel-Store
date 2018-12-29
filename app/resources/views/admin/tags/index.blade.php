@extends('admin.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.tags.index') }}
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Теги</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
            <a href="{{route('admin.tags.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Добавить</a>
            </div>
            <table id="example1" class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <td>{{$tag->id}}</td>
                        <td>{{$tag->name}}</td>
                        <td>
                            <a href="{{route('admin.tags.edit', $tag)}}" class="fa fa-pencil"></a> 
                            <form class="inline-block" method="POST" action="{{route('admin.tags.destroy', $tag)}}">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Действительно удалить?')" class="delete-btn"><i class="fa fa-remove"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tfoot>
            </table>
        </div>  
    </div>
@endsection