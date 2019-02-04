@extends('admin.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.providers.importSettings.create', $provider) }}
@endsection

@section('content')

@if($errors->count())
    <div class="box">
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    </div>
@endif
<form action="{{ route('admin.providers.import.store', $provider) }}" method="POST">
    @csrf
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        @if(count($importTypes))
                            <h4><strong>Available imports variants</strong></h4>
                            <div class="form-group">
                                @foreach($importTypes as $k=>$type)
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="import_method" {{ old('import_method') == $type ? 'checked' : '' }} required value="{{ $type }}">
                                            <strong>{{$type}}</strong>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-warning">
                                Available methods don't exists!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-body"> 
                <div class="row">
                    <div class="col-md-12">
                        <h4><strong>Separator product</strong></h4>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-1">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="product_separator" required {{ old('product_separator') == 'product_separator_selector' ? 'checked' : '' }} value="product_separator_selector">
                                        <strong>Selector</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <input type="text"  class="form-control input-sm" id="name" value="{{ old('product_separator_selector_selector') }}" name="product_separator_selector_selector" placeholder="Name selector">
                            </div>                
                            <div class="col-md-2">
                                <div class="radio">
                                    @foreach($selectorTypes as $type)
                                        <label>
                                            <input type="radio" name="product_separator_selector_selector_type" value="{{ $type}}" {{ old('product_separator_selector_selector_type') == $type ? 'checked' : '' }}>
                                            <strong>{{ $type }}</strong>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-1">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="product_separator" required {{ old('product_separator') == 'product_separator_explode' ? 'checked' : '' }} value="product_separator_explode">
                                        <strong>Explode</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <input type="text"  class="form-control input-sm" value="{{ old('product_separator_explode_selector') }}" id="name" name="product_separator_explode_selector" placeholder="Selector">
                            </div> 
                            <div class="col-md-2">
                                <div class="radio">
                                    @foreach($selectorTypes as $type)
                                        <label>
                                            <input type="radio" name="product_separator_explode_selector_type" value="{{ $type}}" {{ old('product_separator_explode_selector_type') == $type ? 'checked' : '' }}>
                                            <strong>{{ $type }}</strong>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label" for="main">Delimiter</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control input-sm" value="{{ old('product_separator_explode_delimiter') }}" name="product_separator_explode_delimiter" id="main" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="main">Limit</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control input-sm" value="{{ old('product_separator_explode_limit') }}" name="product_separator_explode_limit" id="main" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="product_separator" required {{ old('product_separator') == 'product_separator_substractor' ? 'checked' : '' }} value="product_separator_substractor">
                                        <strong>Substractor</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="main">Main</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control input-sm" value="{{ old('product_separator_substractor_main_selector') }}" name="product_separator_substractor_main_selector" id="main" placeholder="Main selector">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                @foreach($selectorTypes as $type)
                                    <label>
                                        <input type="radio" name="product_separator_substractor_main_selector_type" value="{{ $type}}" {{ old('product_separator_substractor_main_selector_type') == $type ? 'checked' : '' }}>
                                        <strong>{{ $type }}</strong>
                                    </label>
                                @endforeach
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="cut">Cut</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control input-sm" value="{{ old('product_separator_substractor_cut_selector') }}" name="product_separator_substractor_cut_selector" id="cut" placeholder="Cut selector">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                @foreach($selectorTypes as $type)
                                    <label>
                                        <input type="radio" name="product_separator_substractor_cut_selector_type" value="{{ $type}}" {{ old('product_separator_substractor_cut_selector_type') == $type ? 'checked' : '' }}>
                                        <strong>{{ $type }}</strong>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4><strong>Separator variant</strong></h4>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-1">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="variant_separator" required {{ old('variant_separator') == 'variant_separator_selector' ? 'checked' : '' }} value="variant_separator_selector">
                                        <strong>Selector</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <input type="text"  class="form-control input-sm" value="{{ old('variant_separator_selector_selector') }}" id="name" name="variant_separator_selector_selector" placeholder="Name selector">
                            </div>                
                            <div class="col-md-2">
                                <div class="radio">
                                    @foreach($selectorTypes as $k=>$type)
                                        <label>
                                            <input type="radio" name="variant_separator_selector_selector_type" value="{{ $type}}" {{ old('variant_separator_selector_selector_type') == $type ? 'checked' : '' }}>
                                            <strong>{{ $type }}</strong>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-1">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="variant_separator" required {{ old('variant_separator') == 'variant_separator_explode' ? 'checked' : '' }} value="variant_separator_explode">
                                        <strong>Explode</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <input type="text"  class="form-control input-sm" value="{{ old('variant_separator_explode_selector') }}" id="name" name="variant_separator_explode_selector" placeholder="Selector">
                            </div> 
                            <div class="col-md-2">
                                <div class="radio">
                                    @foreach($selectorTypes as $type)
                                        <label>
                                            <input type="radio" name="variant_separator_explode_selector_type" value="{{ $type}}" {{ old('variant_separator_explode_selector_type') == $type ? 'checked' : '' }}>
                                            <strong>{{ $type }}</strong>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label" for="main">Delimiter</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control input-sm" value="{{ old('variant_separator_explode_delimiter') }}" name="variant_separator_explode_delimiter" id="main" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="main">Limit</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control input-sm" value="{{ old('variant_separator_explode_limit') }}" name="variant_separator_explode_limit" id="main" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="variant_separator" required {{ old('variant_separator') == 'variant_separator_substractor' ? 'checked' : '' }} value="variant_separator_substractor">
                                        <strong>Substractor</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="main">Main</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control input-sm" value="{{ old('variant_separator_substractor_main_selector') }}" name="variant_separator_substractor_main_selector" id="main" placeholder="Main selector">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                @foreach($selectorTypes as $type)
                                    <label>
                                        <input type="radio" name="variant_separator_substractor_main_selector_type" value="{{ $type}}" {{ old('variant_separator_substractor_main_selector_type') == $type ? 'checked' : '' }}>
                                        <strong>{{ $type }}</strong>
                                    </label>
                                @endforeach
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="cut">Cut</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control input-sm" value="{{ old('variant_separator_substractor_cut_selector') }}" name="variant_separator_substractor_cut_selector" id="cut" placeholder="Cut selector">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                @foreach($selectorTypes as $type)
                                    <label>
                                        <input type="radio" name="variant_separator_substractor_cut_selector_type" value="{{ $type}}" {{ old('variant_separator_substractor_cut_selector_type') == $type ? 'checked' : '' }}>
                                        <strong>{{ $type }}</strong>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box">   
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Product</label>
                            <input type="text" required class="form-control input-sm" value="{{ old('product_selector') }}" id="name" name="product_selector" placeholder="Product selector">
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <div class="radio">
                            @foreach($selectorTypes as $type)
                                <label>
                                    <input type="radio" name="product_selector_type" value="{{ $type}}" {{ old('product_selector_type') == $type ? 'checked' : '' }}>
                                    <strong>{{ $type }}</strong>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" required class="form-control input-sm" value="{{ old('name_selector') }}" id="name" name="name_selector" placeholder="Name selector">
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <div class="radio">
                            @foreach($selectorTypes as $type)
                                <label>
                                    <input type="radio" name="name_selector_type" value="{{ $type}}" {{ old('name_selector_type') == $type ? 'checked' : '' }}>
                                    <strong>{{ $type }}</strong>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" required class="form-control input-sm" value="{{ old('code_selector') }}" id="code" name="code_selector" placeholder="Code selector">
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <div class="radio">
                                @foreach($selectorTypes as $type)
                                <label>
                                    <input type="radio" name="code_selector_type" value="{{ $type}}" {{ old('code_selector_type') == $type ? 'checked' : '' }}>
                                    <strong>{{ $type }}</strong>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" required class="form-control input-sm" value="{{ old('price_selector') }}" id="price" name="price_selector" placeholder="Price selector">
                        </div>
                    </div>
                    <div class="col-md-2"><br>
                        <div class="radio">
                            @foreach($selectorTypes as $type)
                                <label>
                                    <input type="radio" name="price_selector_type" value="{{ $type}}" {{ old('price_selector_type') == $type ? 'checked' : '' }}>
                                    <strong>{{ $type }}</strong>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-1"><br>
                        <label for="markup"><strong>Наценка:</strong></label>
                    </div>
                    <div class="col-md-1"><br>
                        <input type="number" id="markup" name="markup" class="form-control input-sm" value="{{ old('markup') ? old('markup') : 10 }}" placeholder="%">
                    </div>
                    <div class="col-md-1"><br><strong>(%)</strong></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" required class="form-control input-sm" value="{{ old('description_selector') }}" id="description" name="description_selector" placeholder="Description selector">
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <div class="radio">
                            @foreach($selectorTypes as $type)
                                <label>
                                    <input type="radio" name="description_selector_type" value="{{ $type}}" {{ old('description_selector_type') == $type ? 'checked' : '' }}>
                                    <strong>{{ $type }}</strong>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" required class="form-control input-sm" value="{{ old('quantity_selector') }}" id="quantity" name="quantity_selector" placeholder="Size selector">
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <div class="radio">
                            @foreach($selectorTypes as $k=>$type)
                                <label>
                                    <input type="radio" name="quantity_selector_type" value="{{ $type}}" {{ old('quantity_selector_type') == $type ? 'checked' : '' }}>
                                    <strong>{{ $type }}</strong>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="color">Color</label>
                            <input type="text" required class="form-control input-sm" value="{{ old('color_selector') }}" id="color" name="color_selector" placeholder="Color selector">
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <div class="radio">
                            @foreach($selectorTypes as $k=>$type)
                                <label>
                                    <input type="radio" name="color_selector_type" value="{{ $type}}" {{ old('color_selector_type') == $type ? 'checked' : '' }}>
                                    <strong>{{ $type }}</strong>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="size">Size</label>
                            <input type="text" required class="form-control input-sm" value="{{ old('size_selector') }}" id="size" name="size_selector" placeholder="Size selector">
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <div class="radio">
                            @foreach($selectorTypes as $k=>$type)
                                <label>
                                    <input type="radio" name="size_selector_type" value="{{ $type}}" {{ old('size_selector_type') == $type ? 'checked' : '' }}>
                                    <strong>{{ $type }}</strong>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="size">Size quantity</label>
                            <input type="text" required class="form-control input-sm" value="{{ old('size_quantity_selector') }}" id="size" name="size_quantity_selector" placeholder="Size quantity selector">
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <div class="radio">
                            @foreach($selectorTypes as $k=>$type)
                                <label>
                                    <input type="radio" name="size_quantity_selector_type" value="{{ $type}}" {{ old('size_quantity_selector_type') == $type ? 'checked' : '' }}>
                                    <strong>{{ $type }}</strong>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="text" required class="form-control input-sm" value="{{ old('photo_selector') }}" id="photo" name="photo_selector" placeholder="Photo selector">
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <div class="radio">
                            @foreach($selectorTypes as $k=>$type)
                                <label>
                                    <input type="radio" name="photo_selector_type" value="{{ $type}}" {{ old('photo_selector_type') == $type ? 'checked' : '' }}>
                                    <strong>{{ $type }}</strong>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-1">
                        <a href="{{ route('admin.providers.show', $provider) }}" class="btn btn-default">
                            <i class="fa fa-arrow-circle-left"></i>
                            Назад
                        </a>
                    </div>
                    <div class="col-md-1 pull-right">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i>
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
</form>

@endsection