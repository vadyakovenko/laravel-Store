<?php

namespace App\Http\Controllers\Admin\Provider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Store\Provider\Provider;
use App\Entity\Store\Provider\Import\ImportSettings;
use App\Http\Requests\Store\Providers\ImportSettingsRequest;
use App\UseCases\Store\Providers\ImportSettingsService;
use App\Entity\Store\Provider\Import\Fields\Selector;



class ImportSettingsController extends Controller
{
    protected $service;

    public function __construct(ImportSettingsService $service)
    {
        $this->service = $service;
    }

    public function create(Provider $provider)
    {
        if($provider->importSettings) {
            return redirect()->route('admin.providers.import.edit', [$provider, $provider->importSettings]);
        }

        $selectorTypes = Selector::typesList();
        $importTypes = ImportSettings::importsList();
        return view('admin.providers.import.create', compact( 'provider', 'importTypes', 'selectorTypes'));
    }

    public function store(ImportSettingsRequest $request, Provider $provider)
    {
        $this->service->store($request, $provider);
        return redirect()->route('admin.providers.show', $provider)->with('success', 'Сохранение настроек импорта прошло успешно!');
    }

    public function edit(Provider $provider, ImportSettings $importSettings)
    {
        if(!$provider->importSettings) { 
            return redirect()->route('admin.providers.import.create', $provider);
        }
        $selectorTypes = Selector::typesList();
        $importTypes = ImportSettings::importsList();
        $settings = $provider->importSettings()->first(); 
        return view('admin.providers.import.edit', compact('provider','importSettings', 'importTypes', 'selectorTypes', 'settings'));
    }

    public function update(ImportSettingsRequest $request, Provider $provider, $importSettings)
    {       
        $this->service->update($request, ImportSettings::findOrFail($importSettings));
        return redirect()->route('admin.providers.show', $provider)->with('success', 'Обновление настроек импорта прошло успешно!');
    }
}
