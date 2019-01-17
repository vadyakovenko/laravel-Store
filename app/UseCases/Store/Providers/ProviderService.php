<?php

namespace App\UseCases\Store\Providers;

use App\Entity\Store\Provider\Provider;
use App\Http\Requests\Store\Providers\ProviderRequest;
use App\UseCases\Store\Providers\CategoryService;

class ProviderService
{
    private $category;

    public function __construct(CategoryService $category)
    {
        $this->category = $category;
    }

    public function create(ProviderRequest $request)
    {
       $provider = Provider::create($request->except('_token'));
       $this->category->parse($provider);

       return $provider;
    }
}