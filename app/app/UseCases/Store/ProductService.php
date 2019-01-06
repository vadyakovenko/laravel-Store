<?php

namespace App\UseCases\Store;

use App\Http\Requests\Store\Products\Ajax\SetSizeRequest;
use App\Entity\Store\Product\Size;
use App\Entity\Store\Characteristics\Size as StoreSize;

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
}