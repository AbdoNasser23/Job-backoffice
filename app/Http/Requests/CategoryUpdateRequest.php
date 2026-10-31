<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => [
                "required",
                "string",
                "max:255",
                Rule::unique("job_categories", "name")->ignore($this->route("category")),
            ],
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
