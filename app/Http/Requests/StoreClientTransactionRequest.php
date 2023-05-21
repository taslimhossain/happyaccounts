<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientTransactionRequest extends FormRequest
{

    /**
     * Indicates whether validation should stop after the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

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
        $rules = [
            'project_id'       => ['required','numeric','exists:projects,id'],
            'client_id'       => ['required','numeric','exists:clients,id'],
            'account'       => ['required','numeric','exists:bankings,id'],
            'transaction_type' => ['required', 'numeric','min:1'],
            'amount' => ['required', 'numeric','min:10'],
        ];

        if ($this->input('transaction_type') == \App\Helpers\Constant::TRANSACTIONS['return_to_client']) {
            $rules['amount'] = ['required', 'numeric','min:10','max:'.$this->getBalance($this->input('account'))];
        }

        return $rules;

    }

    public function getBalance($bank_id){
        return \App\Models\Banking::AccountBalance($bank_id);
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'project_id.required' => __('The :attribute field is required', ['attribute' => __('Project')]),
            'project_id.numeric'  => __(':attribute id must be a number', ['attribute' => __('Project')]),
            'project_id.exists'   => __('The selected :attribute id is invalid.', ['attribute' => __('Project')]),

            'client_id.required' => __('The :attribute field is required', ['attribute' => __('Client')]),
            'client_id.numeric'  => __(':attribute id must be a number', ['attribute' => __('Client')]),
            'client_id.exists'   => __('The selected :attribute id is invalid.', ['attribute' => __('Client')]),

            'transaction_type.required' => __('The :attribute have to select', ['attribute' => __('Transaction type')]),
            'transaction_type.numeric'  => __(':attribute field must be a number', ['attribute' => __('Transaction type')]),
            'transaction_type.min'      => __('The :attribute have to select', ['attribute' => __('Transaction type')]),

            'account.required' => __('The :attribute have to select', ['attribute' => __('Account')]),
            'account.numeric'  => __(':attribute have to select', ['attribute' => __('Account')]),
            'account.exists'   => __('The selected :attribute id is invalid.', ['attribute' => __('Account')]),

            'amount.required' => __('The :attribute have to write', ['attribute' => __('Amount')]),
            'amount.numeric'  => __(':attribute field must be a number', ['attribute' => __('Amount')]),
            'amount.min'      => __(':attribute have to be greater than or equal to  :min', ['attribute' => __('Amount')]),
            'amount.max'      => __('The :attribute must be less than or equal to :max taka, Your current balance is :max taka', ['attribute' => __('Amount')]),
        ];
    }


    /**
     * Handle a failed validation attempt.
     */
    protected function withValidator(Validator $validator)
    {
        if ($validator->fails()) {
            $response = redirect()->back()
                ->with(['errors' => $validator->errors(), 'status' => false, 'message' => $validator->errors()->first()])
                ->withInput();
            throw new HttpResponseException($response);
        }
    }

}
