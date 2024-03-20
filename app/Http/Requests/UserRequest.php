<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=>'required',
            'username'=>'required|unique:admins,username,'.$this->id,
            'email'=>'required',
            'password'=>isset($this->id) ? 'nullable' : 'required',
            'designation'=>'required',
            'dob'=>'required',
            'phone_no'=>'required',
            'image' =>isset($this->id) ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048': 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'roles' => 'required|array'
        ];
    }
}
