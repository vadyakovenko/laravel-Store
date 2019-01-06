@extends('admin.layouts.app')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Парсер</h3>
        </div>
        <div class="box-body container-fluid">
            <form action="{{ route('admin.parser.start') }}" method="POST">
                <div class="form-group row">
                    <div class="col-sm-1"><label for="inputEmail3" class="control-label">Link</label></div>       
                    <div class="col-sm-11">
                        <input type="text" name="link" class="form-control" id="inputEmail3" placeholder="link">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-1"><label for="inputEmail3" class="control-label">Name</label></div>       
                    <div class="col-sm-5">
                        <input type="text" name="name" class="form-control" id="inputEmail3">
                    </div>
                    <div class="col-sm-1"><label for="inputEmail3" class="control-label">Original url</label></div>       
                    <div class="col-sm-5">
                        <input type="text" name="url" class="form-control" id="inputEmail3">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-1"><label for="inputEmail3" class="control-label">Price</label></div>       
                    <div class="col-sm-5">
                        <input type="text" name="price" class="form-control" id="inputEmail3" >
                    </div>
                    <div class="col-sm-1"><label for="inputEmail3" class="control-label">Label 1</label></div>            
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputEmail3" >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-1"><label for="inputEmail3" class="control-label">Label 1</label></div>       
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputEmail3">
                    </div>
                    <div class="col-sm-1"><label for="inputEmail3" class="control-label">Label 1</label></div>            
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputEmail3">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Start</button>
            </form>
        </div>  
    </div>
@endsection
