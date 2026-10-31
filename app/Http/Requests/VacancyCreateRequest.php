<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacancyCreateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            "title" => "bail|required|string|max:255",
            "location"=> "required|string|max:255",
            "type" => "required|in:full_time,contract,remote,hybrid",
            "description"=> "required|string|max:255",
            "salary"=>"required|numeric|min:0",
            "company_id"=>"required|exists:companies,id",
            "category_id"=>"required|exists:job_categories,id"
        ];
    }

    public function messages(): array
{
    return [

        'title.required' => 'Job title is required.',
        'title.string' => 'Job title must be a valid text.',
        'title.max' => 'Job title must not exceed 255 characters.',

        'location.required' => 'Job location is required.',
        'location.string' => 'Job location must be a valid text.',
        'location.max' => 'Job location must not exceed 255 characters.',

        'type.required' => 'Employment type is required.',
        'type.string' => 'Employment type must be a valid text.',

        'description.required' => 'Job description is required.',
        'description.string' => 'Job description must be a valid text.',

        'salary.required' => 'Salary is required.',
        'salary.numeric' => 'Salary must be a valid number.',
        'salary.min' => 'Salary must be at least 0.',

        'company_id.required' => 'Company is required.',
        'company_id.exists' => 'Selected company is invalid.',

        'category_id.required' => 'Category is required.',
        'category_id.exists' => 'Selected category is invalid.',

    ];
}
}
