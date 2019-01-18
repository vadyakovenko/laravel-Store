<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Store\Product\Product;
use App\Entity\Store\Product\ProductVariant;
use App\Entity\Store\Characteristics\Size;
use App\Entity\Store\Characteristics\Color;
use App\Entity\Store\Category;
use App\Entity\Store\Provider\Provider;
use App\UseCases\Store\ProductService;

class ProductController extends Controller
{
    private $product;

    public function __construct(ProductService $product)
    {
        $this->product = $product;
    }

    public function index(Request $request)
    {
        $requestData = $request->except('page');
        $categories = Category::defaultOrder()->get();
        $providers = Provider::all();
        $storeSizes = Size::allBySort();
        $colors = Color::allBySort();
        $products= $this->product->getWithFilters($request);

        return view('admin.products.index', compact('products', 'storeSizes', 'colors', 'categories', 'providers', 'requestData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $storeSizes = Size::allBySort();
        $colors = Color::allBySort();
        $categories = Category::defaultOrder()->get();
        return view('admin/products/edit', compact('product', 'categories', 'storeSizes', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
