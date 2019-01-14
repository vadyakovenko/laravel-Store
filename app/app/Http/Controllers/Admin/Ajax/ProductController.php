<?php

namespace App\Http\Controllers\Admin\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Store\Products\Ajax\SetSizeRequest;
use App\Http\Requests\Store\Products\Ajax\SetColorRequest;
use App\Http\Requests\Store\Products\Ajax\SetCategoryRequest;
use App\UseCases\Store\ProductService;

class ProductController extends Controller
{
    private $product;

    public function __construct(ProductService $product)
    {
        $this->product = $product;   
    }

    public function setSize(SetSizeRequest $request)
    {
        $size = $this->product->setSize($request);
        return ['success' => true, 'value' => $size->storeSize->value];
    }

    public function setColor(SetColorRequest $request)
    {
        $variant = $this->product->setColor($request);
        return ['success' => true, 'id' => $variant->id,'name' => $variant->color->name, 'value' => $variant->color->value];
    }

    public function setCategory(SetCategoryRequest $request)
    {
        $product =  $this->product->setCategory($request);
        return ['success' => true, 'categoryPath' => $product->category->path()];

    }
}
