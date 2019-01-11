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
                <th>Сортировка</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
                @foreach($sizes as $size)
                    <tr>
                        <td>{{$size->value}}</td>
                        <td>
                            <form class="inline-block" method="POST" action="{{route('admin.characteristics.sizes.first', $size)}}">
                                @csrf
                                <button type="submit" class="move-btn" title="Наверх"><i class="fa fa-angle-double-up"></i></button>
                            </form>
                            <form class="inline-block" method="POST" action="{{route('admin.characteristics.sizes.up', $size)}}">
                                @csrf
                                <button type="submit" class="move-btn" title="На позицию вверх"><i class="fa fa-angle-up"></i></button>
                            </form>
                            <form class="inline-block" method="POST" action="{{route('admin.characteristics.sizes.down', $size)}}">
                                @csrf
                                <button type="submit" class="move-btn" title="На позицию вниз"><i class="fa fa-angle-down"></i></button>
                            </form>
                            <form class="inline-block" method="POST" action="{{route('admin.characteristics.sizes.last', $size)}}">
                                @csrf
                                <button type="submit" class="move-btn" title="Вниз"><i class="fa fa-angle-double-down"></i></button>
                            </form>
                        </td>
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