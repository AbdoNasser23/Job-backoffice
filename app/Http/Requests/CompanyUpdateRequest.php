<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [

            'name' => [
                'bail',
                'required',
                'string',
                'max:255',
                Rule::unique('companies', 'name')
                    ->ignore($this->route('company')),
            ],

            'address' => [
                'required',
                'string',
                'max:255',
            ],

            'industry_id' => [
                'required',
                'exists:industries,id',
            ],

            'website' => [
                'nullable',
                'url',
                'max:255',
            ],

            // Owner account
            'update_owner' => [
                'nullable',
                'boolean',
            ],

            'owner_name' => [
                'required_if:update_owner,1',
                'nullable',
                'string',
                'max:255',
            ],

            'owner_password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ];
    }

    public function messages(): array
    {
        return [

            'name.required' => 'Company name is required.',
            'name.string' => 'Company name must be a valid text.',
            'name.max' => 'Company name must not exceed 255 characters.',
            'name.unique' => 'This company already exists.',

            'address.required' => 'Company address is required.',
            'address.string' => 'Company address must be a valid text.',
            'address.max' => 'Company address must not exceed 255 characters.',

            'industry_id.required' => 'Industry is required.',
            'industry_id.exists' => 'Selected industry is invalid.',

            'website.url' => 'Website must be a valid url.',
            'website.max' => 'Website must not exceed 255 characters.',

            'owner_name.required_if' => 'Owner name is required.',
            'owner_name.string' => 'Owner name must be a valid text.',
            'owner_name.max' => 'Owner name must not exceed 255 characters.',

            'owner_password.min' => 'Owner password must be at least 8 characters.',
            'owner_password.confirmed' => 'Owner password confirmation does not match.',
        ];
    }
}
