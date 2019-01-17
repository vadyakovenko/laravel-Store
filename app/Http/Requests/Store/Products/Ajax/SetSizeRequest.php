<?php

namespace App\Http\Requests\Store\Products\Ajax;

use Illuminate\Foundation\Http\FormRequest;

class SetSizeRequest extends FormRequest
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
            'sizeId' => ['required', 'exists:sizes_product_variations,id'],
            'storeSizeId' => ['required', 'exists:products_sizes,id']
        ];
    }
}
