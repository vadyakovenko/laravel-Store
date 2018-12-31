@extends('admin.layouts.app')

@section('breadcrumbs')
    {{-- {{ Breadcrumbs::render('admin.tags.index') }} --}}
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Размеры</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
            <a href="{{route('admin.characteristics.sizes.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Добавить</a>
            </div>
            <table id="example1" class="table table-bordered">
            <thead>
            <tr>
                <th>Значение</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
                @foreach($sizes as $size)
                    <tr>
                        <td>{{$size->value}}</td>
                        <td>
                            <a href="{{route('admin.characteristics.sizes.edit', $size)}}" class="fa fa-pencil"></a> 
                            <form class="inline-block" method="POST" action="{{route('admin.characteristics.sizes.destroy', $size)}}">
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