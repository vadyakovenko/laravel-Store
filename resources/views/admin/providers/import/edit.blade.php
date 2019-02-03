@extends('admin.layouts.app')

@section('content'){{ dump($settings) }}
<form action="{{ route('admin.providers.import.update', [$provider, $importSettings]) }}" method="POST">
    @csrf
    @method('PUT')
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
                                            <input type="radio" name="import-method" value="{{ $type }}" {{ $settings['import_method'] == $type ? 'checked' : '' }} >
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
                                        <input type="radio" name="product_separator" {{ $settings['separator_product']['separator_type'] == 'selector_separator' ? 'checked' : '' }} value="product_separator_selector">
                                        <strong>Selector</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <input type="text" require class="form-control input-sm" id="name" value="{{ $settings['separator_product']['separator_type'] == 'selector_separator' ? $settings['separator_product']['selector'] : "" }}" name="product_separator_selector" placeholder="Name selector">
                            </div>                
                            <div class="col-md-2">
                                <div class="radio">
                                    @foreach($selectorTypes as $type)
                                        <label>
                                            <input type="radio" name="product_separator_selector_type" value="{{ $type}}" {{  $settings['separator_product']['separator_type'] == 'selector_separator' ? $settings['separator_product']['type'] == $type ? 'checked' : '' : '' }}>
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
                                        <input type="radio" name="product_separator" {{ $settings['separator_product']['separator_type'] == 'explode_separator' ? 'checked' : '' }} value="product_separator_explode">
                                        <strong>Explode</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <input type="text" require class="form-control input-sm" id="name" value="{{ $settings['separator_product']['separator_type'] == 'explode_separator' ? $settings['separator_product']['selector'] : '' }}" name="explode_selector" placeholder="Selector">
                            </div> 
                            <div class="col-md-2">
                                <div class="radio">
                                    @foreach($selectorTypes as $type)
                                        <label>
                                            <input type="radio" name="product_separator_explode_selector_type" {{ $settings['separator_product']['separator_type'] == 'explode_separator' ? $settings['separator_product']['type'] == $type ? 'checked' : '' : '' }} value="{{ $type}}">
                                            <strong>{{ $type }}</strong>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label" for="main">Delimiter</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control input-sm" value="{{ $settings['separator_product']['separator_type'] == 'explode_separator' ? $settings['separator_product']['delimiter'] : '' }}" name="product_separator_explode_delimiter" id="main" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="main">Limit</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control input-sm" value="{{ $settings['separator_product']['separator_type'] == 'explode_separator' ? $settings['separator_product']['limit'] : '' }}" name="product_separator_explode_limit" id="main" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="product_separator" {{ $settings['separator_product']['separator_type'] == 'substructor_separator' ? 'checked' : '' }} value="product_separator_substractor">
                                        <strong>Substractor</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="main">Main</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control input-sm" name="product_separator_substractor_main_selector" id="main" placeholder="Main selector"
                                            value="{{ $settings['separator_product']['separator_type'] == 'substructor_separator' ? $settings['separator_product']['main_selector'] : '' }}"                                         
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                @foreach($selectorTypes as $k=>$type)
                                    <label>
                                        <input type="radio" name="product_separator_substractor_main_selector_type" value="{{ $type}}" {{ $k==0 ? 'checked' : '' }}
                                            {{ $settings['separator_product']['separator_type'] == 'substructor_separator' ? $settings['separator_product']['main_selector_type'] == $type ? 'checked' : '' : '' }}                                                                                
                                        >
                                        <strong>{{ $type }}</strong>
                                    </label>
                                @endforeach
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="cut">Cut</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control input-sm" name="product_separator_substractor_cut_selector" id="cut" placeholder="Cut selector"
                                            value="{{ $settings['separator_product']['separator_type'] == 'substructor_separator' ? $settings['separator_product']['cut_selector'] : '' }}"                                         
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                @foreach($selectorTypes as $k=>$type)
                                    <label>
                                        <input type="radio" name="product_separator_substractor_cut_selector_type" value="{{ $type}}" {{ $k==0 ? 'checked' : '' }}
                                            {{ $settings['separator_product']['separator_type'] == 'substructor_separator' ? $settings['separator_product']['cut_selector_type'] == $type ? 'checked' : '' : '' }}                                        
                                        >
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
                                        <input type="radio" name="variant_separator" {{ $settings['separator_variant']['separator_type'] == 'selector_separator' ? 'checked' : '' }} value="variant_separator_selector">
                                        <strong>Selector</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <input type="text" require class="form-control input-sm" id="name" value="{{ $settings['separator_variant']['separator_type'] == 'selector_separator' ? $settings['separator_variant']['selector'] : "" }}" name="variant_separator_selector" placeholder="Name selector">
                            </div>                
                            <div class="col-md-2">
                                <div class="radio">
                                    @foreach($selectorTypes as $k=>$type)
                                        <label>
                                            <input type="radio" name="variant_separator_selector_type" value="{{ $type}}" {{  $settings['separator_variant']['separator_type'] == 'selector_separator' ? $settings['separator_variant']['type'] == $type ? 'checked' : '' : '' }}>
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
                                        <input type="radio" name="variant_separator" {{ $settings['separator_variant']['separator_type'] == 'explode_separator' ? 'checked' : '' }} value="variant_separator_explode">
                                        <strong>Explode</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <input type="text" require class="form-control input-sm" id="name" value="{{ $settings['separator_variant']['separator_type'] == 'explode_separator' ? $settings['separator_variant']['selector'] : '' }}" name="explode_selector" placeholder="Selector">
                            </div> 
                            <div class="col-md-2">
                                <div class="radio">
                                    @foreach($selectorTypes as $k=>$type)
                                        <label>
                                            <input type="radio" name="variant_separator_explode_selector_type" value="{{ $type}}" {{ $settings['separator_variant']['separator_type'] == 'explode_separator' ? $settings['separator_variant']['type'] == $type ? 'checked' : '' : '' }}>
                                            <strong>{{ $type }}</strong>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label" for="main">Delimiter</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control input-sm" name="variant_separator_explode-delimiter" value="{{ $settings['separator_variant']['separator_type'] == 'explode_separator' ? $settings['separator_variant']['delimiter'] : '' }}" id="main" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="main">Limit</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control input-sm" value="{{ $settings['separator_variant']['separator_type'] == 'explode_separator' ? $settings['separator_variant']['limit'] : '' }}" name="variant_separator_explode-limit" id="main" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="variant_separator" {{ $settings['separator_variant']['separator_type'] == 'substructor_separator' ? 'checked' : '' }} value="variant_separator_substractor">
                                        <strong>Substractor</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="main">Main</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control input-sm" 
                                            value="{{ $settings['separator_variant']['separator_type'] == 'substructor_separator' ? $settings['separator_variant']['main_selector'] : '' }}" 
                                            name="variant_separator_substractor_main_selector" id="main" placeholder="Main selector"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                @foreach($selectorTypes as $k=>$type)
                                    <label>
                                        <input type="radio" name="variant_separator_substractor_main_selector_type" value="{{ $type}}" 
                                            {{ $settings['separator_variant']['separator_type'] == 'substructor_separator' ? $settings['separator_variant']['main_selector_type'] == $type ? 'checked' : '' : '' }}
                                        >
                                        <strong>{{ $type }}</strong>
                                    </label>
                                @endforeach
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="cut">Cut</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control input-sm" 
                                            value="{{ $settings['separator_variant']['separator_type'] == 'substructor_separator' ? $settings['separator_variant']['cut_selector'] : '' }}" 
                                            name="variant_separator_substractor_cut_selector" id="cut" placeholder="Cut selector"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                @foreach($selectorTypes as $k=>$type)
                                    <label>
                                        <input type="radio" name="variant_separator_substractor_cut_selector_type" value="{{ $type}}" {{ $k==0 ? 'checked' : '' }}
                                            {{ $settings['separator_variant']['separator_type'] == 'substructor_separator' ? $settings['separator_variant']['cut_selector_type'] == $type ? 'checked' : '' : '' }}
                                        >
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
                            <input type="text" require class="form-control input-sm" id="name" value="{{ $settings['product'] ? $settings['product']['selector'] : '' }}" name="product_selector" placeholder="Product selector">
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <div class="radio">
                            @foreach($selectorTypes as $type)
                                <label>
                                    <input type="radio" name="product_selector_type" value="{{ $type}}" {{ $settings['product'] ? $settings['product']['type'] == $type ? 'checked' : '' : '' }}>
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
                            <input type="text" require class="form-control input-sm" id="name" value="{{ $settings['name'] ? $settings['name']['selector'] : '' }}" name="name_selector" placeholder="Name selector">
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <div class="radio">
                            @foreach($selectorTypes as $k=>$type)
                                <label>
                                    <input type="radio" name="name_selector_type" value="{{ $type}}" {{ $settings['name'] ? $settings['name']['type'] == $type ? 'checked' : '' : '' }}>
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
                            <input type="text" require class="form-control input-sm" id="code" value="{{ $settings['code'] ? $settings['code']['selector'] : '' }}" name="code_selector" placeholder="Code selector">
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <div class="radio">
                                @foreach($selectorTypes as $k=>$type)
                                <label>
                                    <input type="radio" name="code_selector_type" {{ $settings['code'] ? $settings['code']['type'] == $type ? 'checked' : '' : '' }} value="{{ $type}}" {{ $k==0 ? 'checked' : '' }}>
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
                            <input type="text" require class="form-control input-sm" id="price" value="{{ $settings['price'] ? $settings['price']['selector'] : '' }}" name="price_selector" placeholder="Price selector">
                        </div>
                    </div>
                    <div class="col-md-2"><br>
                        <div class="radio">
                            @foreach($selectorTypes as $k=>$type)
                                <label>
                                    <input type="radio" name="price_selector_type" value="{{ $type}}" {{ $settings['price'] ? $settings['price']['type'] == $type ? 'checked' : '' : '' }}>
                                    <strong>{{ $type }}</strong>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-1"><br>
                        <label for="markup"><strong>Наценка:</strong></label>
                    </div>
                    <div class="col-md-1"><br>
                        <input type="number" id="markup" value="{{ $settings['price'] ? $settings['price']['markup'] : '' }}" name="markup" class="form-control input-sm" value="10" placeholder="%">
                    </div>
                    <div class="col-md-1"><br><strong>(%)</strong></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" require class="form-control input-sm" id="description" value="{{ $settings['description'] ? $settings['description']['selector'] : '' }}" name="description_selector" placeholder="Description selector">
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <div class="radio">
                            @foreach($selectorTypes as $type)
                                <label>
                                    <input type="radio" name="description_selector_type"  value="{{ $type}}" {{ $settings['description'] ? $settings['description']['type'] == $type ? 'checked' : '' : '' }}>
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
                            <input type="text" require class="form-control input-sm" id="quantity"  value="{{ $settings['quantity'] ? $settings['quantity']['selector'] : '' }}" name="quantity_selector" placeholder="Quantity selector">
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <div class="radio">
                            @foreach($selectorTypes as $k=>$type)
                                <label>
                                    <input type="radio" name="quantity_selector_type" value="{{ $type}}" {{ $settings['quantity'] ? $settings['quantity']['type'] == $type ? 'checked' : '' : '' }}>
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
                            <input type="text" require class="form-control input-sm" id="color" value="{{ $settings['color'] ? $settings['color']['selector'] : '' }}" name="color_selector" placeholder="Color selector">
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <div class="radio">
                            @foreach($selectorTypes as $type)
                                <label>
                                    <input type="radio" name="color_selector_type" value="{{ $type}}" {{ $settings['color'] ? $settings['color']['type'] == $type ? 'checked' : '' : '' }}>
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
                            <input type="text" require class="form-control input-sm" id="size" value="{{ $settings['size'] ? $settings['size']['size_selector'] : '' }}" name="size_selector" placeholder="Size selector">
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <div class="radio">
                            @foreach($selectorTypes as $k=>$type)
                                <label>
                                    <input type="radio" name="size_selector_type" value="{{ $type}}" {{ $settings['size'] ? $settings['size']['size_type'] == $type ? 'checked' : '' : '' }}>
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
                            <input type="text" require class="form-control input-sm" id="size" value="{{ $settings['size'] ? $settings['size']['quantity_selector'] : '' }}" name="size_quantity_selector" placeholder="Size quantity selector">
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <div class="radio">
                            @foreach($selectorTypes as $type)
                                <label>
                                    <input type="radio" name="size_quantity_selector_type" value="{{ $type}}" {{ $settings['size'] ? $settings['size']['quantity_type'] == $type ? 'checked' : '' : '' }}>
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
                            <input type="text" require class="form-control input-sm" id="photo" value="{{ $settings['photo'] ? $settings['photo']['selector'] : '' }}" name="photo_selector" placeholder="Photo selector">
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <div class="radio">
                            @foreach($selectorTypes as $type)
                                <label>
                                    <input type="radio" name="photo_selector_type" value="{{ $type}}" {{ $settings['photo'] ? $settings['photo']['type'] == $type ? 'checked' : '' : '' }}>
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