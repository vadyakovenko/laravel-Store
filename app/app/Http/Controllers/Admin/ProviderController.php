<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Providers\ProviderRequest;
use App\Entity\Provider\Provider;

class ProviderController extends Controller
{
    public function index()
    {
        $providers = Provider::paginate(20);
        return view('admin.provider.index', compact('providers'));
    }

    public function create()
    {
        return view('admin.provider.create');
    }


    public function store(ProviderRequest $request)
    {
        if(!Provider::create($request->except('_token'))) {
            throw new \RuntimeException('Error saving new provider!');
        }
        return redirect()->route('admin.provider.index')->with('success', 'Новый поставщик успешно добавлен!');
    }

    public function edit(Provider $provider)
    {
        return view('admin.provider.edit', ['provider' => $provider]);
    }


    public function update(ProviderRequest $request, Provider $provider)
    {
        if(!$provider->update($request->except('_token'))) {
            throw new \RuntimeException('Error updating provider!');
        }
        return redirect()->route('admin.provider.index')->with('success', 'Информиция о поставщике успешно обновлена!');
    }

    public function destroy(Provider $provider)
    {
        if(!$provider->delete()) {
            throw new \RuntimeException('Error deleting provider!');
        }
        return redirect()->route('admin.provider.index')->with('success', 'Поставщик успешно удален!');
    }
}
