<?php

namespace App\Http\Requests\Store\Characteristics\Color;

use Illuminate\Foundation\Http\FormRequest;

class ColorUpdateRequest extends FormRequest
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
            'name' => ['string', 'unique:products_colors,name,' . $this->color->id],
            'value' => ['string', 'unique:products_colors,value,' . $this->color->id]
        ];
    }
}
