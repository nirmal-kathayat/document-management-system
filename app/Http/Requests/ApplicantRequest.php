<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantRequest extends FormRequest
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
            if($this->step == 'one'){
                return [
                    'continent_id' =>'required',
                    'country_id' => 'required',
                    'job_position_id' => 'required',
                    'contact_no' =>'required',
                    'personal_details' => 'nullable|array',
                    'passport_details' => 'nullable|array',
                    'family_details' => 'nullable|array',
                    'referred_by' => 'nullable',
                    'step' => 'nullable',
                    'attachments' => 'nullable|array',


                ];
            }else if($this->step == 'two'){
                return [
                    'step' => 'nullable',
                    'experiences' => 'nullable|array',
                ];
            }else if($this->step == 'three'){
                return [
                    'step' => 'nullable',
                    'educations' => 'nullable|array',
                    'personal_checklist' => 'nullable|array',
                    'on_job_checklist' => 'nullable|array',
                ];
            }else if($this->step=='four'){
                return [
                    'step' => 'nullable',
                    'attachments' => 'nullable|array',
                    'redirect_path' =>'nullable'
                ];
            }
       
    }
}
