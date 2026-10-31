<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'bail',
                'required',
                'string',
                'max:255',
                'unique:companies,name',
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

            // Owner type
            'owner_type' => [
                'required',
                Rule::in(['new', 'existing']),
            ],

            // New owner
            'owner_name' => [
                'required_if:owner_type,new',
                'nullable',
                'string',
                'max:255',
            ],

            'owner_email' => [
                'required_if:owner_type,new',
                'nullable',
                'email',
                'unique:users,email',
            ],

            'owner_password' => [
                'required_if:owner_type,new',
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],

            // Existing owner
            'user_id' => [
                'required_if:owner_type,existing',
                'nullable',
                Rule::exists('users', 'id')->where(
                    fn ($query) => $query->where('role', 'company_owner')
                ),
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

            'owner_type.required' => 'Please choose a company owner option.',
            'owner_type.in' => 'Invalid company owner option.',

            'owner_name.required_if' => 'Owner name is required.',
            'owner_name.string' => 'Owner name must be a valid text.',
            'owner_name.max' => 'Owner name must not exceed 255 characters.',

            'owner_email.required_if' => 'Owner email is required.',
            'owner_email.email' => 'Owner email must be a valid email address.',
            'owner_email.unique' => 'This email is already registered.',

            'owner_password.required_if' => 'Owner password is required.',
            'owner_password.string' => 'Owner password must be a valid text.',
            'owner_password.min' => 'Owner password must be at least 8 characters.',
            'owner_password.confirmed' => 'Owner password confirmation does not match.',

            'user_id.required_if' => 'Please select an existing company owner.',
            'user_id.exists' => 'Selected company owner is invalid.',
        ];
    }
}
