<?php

namespace App\Http\Requests\Store\Products\Ajax;

use Illuminate\Foundation\Http\FormRequest;

class SetCategoryRequest extends FormRequest
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
            "productId" => ['required', 'exists:products,id'],
            "categoryId" => ['required', 'exists:categories,id']
        ];
    }
}
