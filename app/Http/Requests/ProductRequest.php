<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    : array
    {
        if ( $this->getMethod() === 'PUT' ) {
            return [
                'title'       => 'required|string|max:255|unique:products,title,' . $this->product->id,
                'description' => 'required|string',
            ];
        }

        return [
            'title'       => 'required|string|max:255|unique:products,title',
            'description' => 'required|string',
        ];
    }
}
