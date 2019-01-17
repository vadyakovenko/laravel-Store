<?php

namespace App\Http\Requests\Store\Products\Ajax;

use Illuminate\Foundation\Http\FormRequest;

class SetColorRequest extends FormRequest
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
            'variantId' => ['required', 'exists:products_variations,id'],
            'colorId' => ['required', 'exists:products_colors,id']
        ];
    }
}
