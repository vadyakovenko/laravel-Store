<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Store\Providers\ProviderRequest;
use App\Entity\Store\Provider\Provider;
use App\UseCases\Store\Providers\ProviderService;
use App\Entity\Store\Category;

class ProviderController extends Controller
{
    private $provider;

    public function __construct(ProviderService $provider)
    {
        $this->provider = $provider;
    }

    public function index()
    {
        $providers = Provider::paginate(20);
        return view('admin.providers.index', compact('providers'));
    }

    public function create()
    {
        return view('admin.providers.create');
    }

    public function store(ProviderRequest $request)
    {
        $this->provider->create($request);
        return redirect()->route('admin.providers.index')->with('success', 'Новый поставщик успешно добавлен!');
    }

    public function show(Provider $provider)
    {
        $providerCategories = $provider->categories()->orderBy('id', 'desc')->get();
        $storeCategories = Category::treeWithDepth();
        return view('admin.providers.show', compact('provider', 'providerCategories', 'storeCategories'));
    }

    public function edit(Provider $provider)
    {
        return view('admin.providers.edit', ['provider' => $provider]);
    }

    public function update(ProviderRequest $request, Provider $provider)
    {
        $provider->update($request->except('_token'));
        return redirect()->route('admin.providers.index')->with('success', 'Информиция о поставщике успешно обновлена!');
    }

    public function destroy(Provider $provider)
    {
        if(!$provider->delete()) {
            throw new \RuntimeException('Error deleting provider!');
        }
        return redirect()->route('admin.providers.index')->with('success', 'Поставщик успешно удален!');
    }
}
