<?php

namespace App\Http\Requests\Store\Providers;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
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
            'name' => ['required'],
            'url' => ['required', 'url'],
            'email' => ['nullable', 'email'],
            'xml_url' => ['required', 'url']
        ];
    }
}
