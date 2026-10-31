<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => "required|string|max:255|unique:job_categories,name",
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter a category name.',
            'name.string'   => 'Category name must be text.',
            'name.max'      => 'Category name must not exceed 255 characters.',
            'name.unique'   => 'This category already exists.',
        ];
    }
}
