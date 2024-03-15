<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PassportRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "first_name" => 'required',
            "last_name" => 'required',
            'dob' => 'required',
            'expiry_date' =>'required',
            'issued_date' => 'required',
            'type' => 'required',
            'district' => 'required',
            'nationality' => 'required',
            'country_code' => 'required',
            'gender' => 'required',
            'citizen_no' => 'nullable',
            'passport_no' => 'required|unique:passports,passport_no,'.$this->id,
            'image' =>isset($this->id) ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048': 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}
