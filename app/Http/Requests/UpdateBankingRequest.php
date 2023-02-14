<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBankingRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'bank_name'       => ['required', 'max:255'],
            'account_name'    => ['required', 'max:255'],
            'account_number'  => ['required', 'integer'],
            'initial_balance' => ['required', 'integer'],
        ];
    }


   /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'account_number.integer' => __(':attribute must be a valid number.', ['attribute' => __('Account number')]),
            'initial_balance.integer' => __(':attribute must be a valid amount.', ['attribute' => __('Initial balance')]),
        ];
    }

}
