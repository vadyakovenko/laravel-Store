<?php

namespace App\Http\Controllers\Admin\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Store\Provider\Category;
use App\Entity\Store\Category as StoreCategory;

class ProviderController extends Controller
{
    public function attach(Request $request)
    {
        $data = $request->all();
        $category = Category::findOrFail($data['categoryId']);
        $storeCategory = StoreCategory::findOrFail($data['storeCategoryId']);
        $category->storeCategory()->associate($storeCategory)->save();
        return ['success' => '1'];   
    }
}
