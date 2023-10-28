<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    : array
    {
        // create title unique validation for update and store method
        if ( $this->getMethod() === 'PUT' ) {
            return [
                'title'       => 'required|string|max:255|unique:blogs,title,' . $this->blog->id,
                'description' => 'required|string',
            ];
        }

        return [
            'title'       => 'required|string|max:255|unique:blogs,title',
            'description' => 'required|string',
        ];
    }
}
