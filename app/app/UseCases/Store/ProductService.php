<?php

namespace App\UseCases\Store;

use App\Http\Requests\Store\Products\Ajax\SetSizeRequest;
use App\Http\Requests\Store\Products\Ajax\SetColorRequest;
use App\Entity\Store\Product\Size;
use App\Entity\Store\Characteristics\Size as StoreSize;
use App\Entity\Store\Product\ProductVariant;
use App\Entity\Store\Characteristics\Color;


class ProductService
{
    public function setSize (SetSizeRequest $request)
    {
        $data = $request->validated();

        $size = Size::findOrFail($data['sizeId']);
        $storeSize = StoreSize::findOrFail($data['storeSizeId']);

        $size->storeSize()->associate($storeSize)->save();   
        return $size;  
    }

    public function setColor(SetColorRequest $request)
    {
        $data = $request->validated();
        $variant = ProductVariant::findOrFail($data['variantId']);
        $color = Color::findOrFail($data['colorId']);
        $variant->color()->associate($color)->save();   
        return $variant;
    }
}