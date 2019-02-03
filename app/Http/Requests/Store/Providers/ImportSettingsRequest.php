<?php

namespace App\Http\Requests\Store\Providers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Entity\Store\Provider\Import\ImportSettings;
use App\Entity\Store\Provider\Import\Fields\Selector;

class ImportSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [ 
            'import_method' => ['required', Rule::in(ImportSettings::importsList())],
            'product_separator' => ['required'],
            'variant_separator' => ['required'],

            "product_separator_selector_selector" =>                ['required_if:product_separator,product_separator_selector'],
            "product_separator_selector_selector_type" =>           ['required_if:product_separator,product_separator_selector'],
            "product_separator_explode_selector" =>                 ['required_if:product_separator,product_separator_explode'],
            "product_separator_explode_selector_type" =>            ['required_if:product_separator,product_separator_explode'],
            "product_separator_explode_delimiter" =>                ['required_if:product_separator,product_separator_explode'],
            "product_separator_explode_limit" =>                    ['required_if:product_separator,product_separator_explode'],
            "product_separator_substractor_main_selector" =>        ['required_if:product_separator,product_separator_substractor'], 
            "product_separator_substractor_main_selector_type" =>   ['required_if:product_separator,product_separator_substractor'], 
            "product_separator_substractor_cut_selector" =>         ['required_if:product_separator,product_separator_substractor'],
            "product_separator_substractor_cut_selector_type" =>    ['required_if:product_separator,product_separator_substractor'], 
            "variant_separator_selector_selector" =>                ['required_if:variant_separator,variant_separator_selector'],
            "variant_separator_selector_selector_type" =>           ['required_if:variant_separator,variant_separator_selector'], 
            "variant_separator_explode_selector" =>                 ['required_if:variant_separator,variant_separator_explode'],
            "variant_separator_explode_selector_type" =>            ['required_if:variant_separator,variant_separator_explode'], 
            "variant_separator_explode_delimiter" =>                ['required_if:variant_separator,variant_separator_explode'],
            "variant_separator_explode_limit" =>                    ['required_if:variant_separator,variant_separator_explode'],
            "variant_separator_substractor_main_selector" =>        ['required_if:variant_separator,variant_separator_substractor'], 
            "variant_separator_substractor_main_selector_type" =>   ['required_if:variant_separator,variant_separator_substractor'],
            "variant_separator_substractor_cut_selector" =>         ['required_if:variant_separator,variant_separator_substractor'],
            "variant_separator_substractor_cut_selector_type" =>    ['required_if:variant_separator,variant_separator_substractor'], 




            'product_selector' =>           ['required'],
            'product_selector_type' =>      ['required', Rule::in(Selector::typesList())],
            'name_selector' =>              ['required'],
            'name_selector_type' =>         ['required', Rule::in(Selector::typesList())],
            'code_selector' =>              ['required'],
            'code_selector_type' =>         ['required', Rule::in(Selector::typesList())],
            'price_selector' =>             ['required'],
            'price_selector_type' =>        ['required', Rule::in(Selector::typesList())],
            'description_selector' =>       ['required'],
            'description_selector_type' =>  ['required', Rule::in(Selector::typesList())],
            'quantity_selector' =>          ['required'],
            'quantity_selector_type' =>     ['required', Rule::in(Selector::typesList())],
            'color_selector' =>             ['required'],
            'color_selector_type' =>        ['required', Rule::in(Selector::typesList())],
            'size_selector' =>              ['required'],
            'size_selector_type' =>         ['required', Rule::in(Selector::typesList())],
            'photo_selector' =>             ['required'],
            'photo_selector_type' =>        ['required', Rule::in(Selector::typesList())],
        ];
    }
}
