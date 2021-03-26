<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Split_HFDC_V2 extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'txtFName' => 'required|min:2',
            'txtLName' => 'required|min:2',
            'txtPostCode' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:10',
            'txtEmail' => 'required|email',
            'txtPhone' => 'required|numeric',
        ];

        
        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'lstTitle.required' => 'The title field is required.',
            'lstTitle.max'=> 'The title exceeds 5 characters.',
            'txtFName.required' => 'The first name field is required.',
            'txtFName.min' => 'The first name minimum is 2 characters.',
            'txtLName.required' => 'The last name field is required.',
            'txtLName.min' => 'The last name minimum is 2 characters.',
            'chkBankName.required' => 'The bank field is required.',
            'jointacc.required' => 'The bank account field is required.',
            'lstDobDay.required'=> 'The date of birth day field is required.',
            'lstDobDay.number'=> 'The date of birth day field must be number.',
            'lstDobMonth.required'=> 'The date of birth month field is required.',
            'lstDobMonth.number'=> 'The date of birth month field must be number.',
            'lstDobYear.required'=> 'The date of birth year field is required.',
            'lstDobYear.number'=> 'The date of birth year field must be number.',
            'txtPostCode.required'=> 'The postcode field is required.',
            'txtPostCode.number'=> 'The postcode field must be number.',
            'address1.required'=> 'The address field is required.',
            'txtEmail.required'=> 'The email field is required.',
            'txtEmail.email'=> 'The email field must be email format.',
            'txtPhone.required'=> 'The phone field is required.',
            'txtPhone.number'=> 'The phone field must be number.',
            'txtJoinFName.required'=> 'The joint account first name field is required.',
            'txtJoinFName.min' => 'The joint account first name minimum is 2 characters.',
            'txtJoinLName.required'=> 'The joint account last name field is required.',
            'txtJoinLName.min' => 'The joint account last name minimum is 2 characters.',
            'lstJoinDobDay.required'=> 'The joint account date of birth day field is required.',
            'lstJoinDobDay.number'=> 'The joint account date of birth day field must be number.',
            'lstJoinDobMonth.required'=> 'The joint account date of birth month field is required.',
            'lstJoinDobMonth.number'=> 'The joint account date of birth day field  must be number.',
            'lstJoinDobYear.required'=> 'The joint account date of birth year field is required.',
            'lstJoinDobYear.number'=> 'The joint account date of birth day field must be number.',
        ];
    }
}
