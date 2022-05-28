<?php

namespace App\Http\Requests\Merchants;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'array:ar,en'],
            'name.ar' => ['required', 'string'],
            'name.en' => ['required', 'string'],
            'description' => ['required', 'array:ar,en'],
            'description.ar' => ['required', 'string'],
            'description.en' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'store_id' => ['required', 'exists:stores,id'],
        ];
    }
}
