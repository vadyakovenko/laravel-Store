@extends('admin.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.imports.index') }}
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Импорт товаров</h3>
        </div>
        <div class="box-body ">
            @foreach($providers as $provider)
                <div class="wrap">
                    <div class="col-md-3">
                        <span><i class="fa fa-cart-arrow-down"></i> {{ $provider->name }}</span>  
                        <a href="{{ route('admin.providers.show', $provider) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>  
                    </div>
                    <div class="col-md-2">
                        <span>Status: 
                            @if($provider->importSettings)
                                <i class="label label-success">Ready</i> 
                            @else
                                <i class="label label-warning">Wait</i> 
                            @endif
                        </span> 
                    </div>
                    <div class="col-md-4 btn-group">
                        <a class="btn btn-default" href="{{ route('admin.providers.show', $provider) }}" target="_blank"><i class="fa fa-list-ul"></i> Import settings</a>
                        <a class="btn btn-default" href="{{ $provider->xml_url }}" target="_blank"><i class="fa fa-file-text"></i> XML</a>
                        <a class="btn btn-default" href="/" target="_blank"><i class="fa  fa-file"></i> Log</a>
                    </div>
                    <form method="POST" action="{{ route('admin.imports.start', $provider) }}"> @csrf
                        <button type="submit" class="btn btn-success btn-rigth-radius pull-right" {{ $provider->importSettings ? '' : 'disabled' }}><i class="fa fa-rocket"></i> Start import</button>
                    </form>
                    <div class="clearfix"></div>
                </div>
            @endforeach
        </div>  
    </div>
@endsection
