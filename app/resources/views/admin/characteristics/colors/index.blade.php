@extends('admin.layouts.app')

@section('breadcrumbs')
    {{-- {{ Breadcrumbs::render('admin.tags.index') }} --}}
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Цвета</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
            <a href="{{route('admin.characteristics.colors.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Добавить</a>
            </div>
            <table id="example1" class="table table-bordered">
            <thead>
            <tr>
                <th>Название</th>
                <th>Значение</th>
                <th>Вид</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
                @foreach($colors as $color)
                    <tr>
                        <td>{{$color->name}}</td>
                        <td>{{$color->value}}</td>
                        <td><span class="label" style="background:{{$color->value}};border-radius:50%;border:1px solid #000">&#160&#160&#160</span></td>
                        <td>
                            <a href="{{route('admin.characteristics.colors.edit', $color)}}" class="fa fa-pencil"></a> 
                            <form class="inline-block" method="POST" action="{{route('admin.characteristics.colors.destroy', $color)}}">
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