<?php

namespace App\UseCases\Store\Providers;

use App\Http\Requests\Store\Providers\ImportSettingsRequest;
use App\Entity\Store\Provider\Provider;
use App\Entity\Store\Provider\Import\ImportSettings;
use App\Entity\Store\Provider\Import\Fields\SeparatorField;
use App\Entity\Store\Provider\Import\Fields\SimpleField;
use App\Entity\Store\Provider\Import\Fields\Selector;
use App\Entity\Store\Provider\Import\Fields\PriceField;
use App\Entity\Store\Provider\Import\Fields\SizeField;


class ImportSettingsService
{
    public function store(ImportSettingsRequest $request, Provider $provider)
    {
        $data = $request->except('_token');
        $importSettings = ImportSettings::create([
            'provider_id' => $provider->id,

            'import_method' => $data['import_method'],
            
            'separator_product' => SeparatorField::createField($data['product_separator'], $data)->list(),
            'separator_variant' => SeparatorField::createField($data['variant_separator'], $data)->list(),

            'product' =>     SimpleField::create( new Selector($data['product_selector'], $data['product_selector_type'], $data['product_selector_attr']) )->list(),
            'name' =>        SimpleField::create( new Selector($data['name_selector'], $data['name_selector_type'], $data['name_selector_attr']) )->list(),
            'code' =>        SimpleField::create( new Selector($data['code_selector'], $data['code_selector_type'], $data['code_selector_attr']) )->list(),
            'price' =>       PriceField::create(new Selector($data['price_selector'], $data['price_selector_type'], $data['price_selector_attr']), (int)$data['markup'] )->list(),
            'description' => SimpleField::create( new Selector($data['description_selector'], $data['description_selector_type'], $data['description_selector_attr']) )->list(),
            'quantity' =>    SimpleField::create( new Selector($data['quantity_selector'], $data['quantity_selector_type'], $data['quantity_selector_attr']) )->list(),
            'color' =>       SimpleField::create( new Selector($data['color_selector'], $data['color_selector_type'], $data['color_selector_attr']) )->list(),
            'size' =>        SizeField::create( 
                                                new Selector($data['size_selector'], $data['size_selector_type'], $data['size_selector_attr']), 
                                                new Selector($data['size_quantity_selector'], $data['size_quantity_selector_type'], $data['size_quantity_selector_attr'])
                                              )->list(),
            'photo' =>       SimpleField::create( new Selector($data['photo_selector'], $data['photo_selector_type'], $data['photo_selector_attr']) )->list(),
        ]);

        return $importSettings;
    }

    public function update(ImportSettingsRequest $request, ImportSettings $importSettings)
    {
        $data = $request->except('_token');
        $importSettings = $importSettings->update([
            'import_method' => $data['import_method'],
            
            'separator_product' => SeparatorField::createField($data['product_separator'], $data)->list(),
            'separator_variant' => SeparatorField::createField($data['variant_separator'], $data)->list(),

            'product' =>     SimpleField::create( new Selector($data['product_selector'], $data['product_selector_type'], $data['product_selector_attr']) )->list(),
            'name' =>        SimpleField::create( new Selector($data['name_selector'], $data['name_selector_type'], $data['name_selector_attr']) )->list(),
            'code' =>        SimpleField::create( new Selector($data['code_selector'], $data['code_selector_type'], $data['code_selector_attr']) )->list(),
            'price' =>       PriceField::create(new Selector($data['price_selector'], $data['price_selector_type'], $data['price_selector_attr']), (int)$data['markup'] )->list(),
            'description' => SimpleField::create( new Selector($data['description_selector'], $data['description_selector_type'], $data['description_selector_attr']) )->list(),
            'quantity' =>    SimpleField::create( new Selector($data['quantity_selector'], $data['quantity_selector_type'], $data['quantity_selector_attr']) )->list(),
            'color' =>       SimpleField::create( new Selector($data['color_selector'], $data['color_selector_type'], $data['color_selector_attr']) )->list(),
            'size' =>        SizeField::create( 
                                                new Selector($data['size_selector'], $data['size_selector_type'], $data['size_selector_attr']), 
                                                new Selector($data['size_quantity_selector'], $data['size_quantity_selector_type'], $data['size_quantity_selector_attr'])
                                              )->list(),
            'photo' =>       SimpleField::create( new Selector($data['photo_selector'], $data['photo_selector_type'], $data['photo_selector_attr']) )->list(),
        ]);

        return $importSettings;
    }
}