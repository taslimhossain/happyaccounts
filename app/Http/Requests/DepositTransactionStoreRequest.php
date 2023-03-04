<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class DepositTransactionStoreRequest extends FormRequest
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
            'account'       => ['required','numeric','exists:bankings,id'],
            'transaction_type' => ['required', 'numeric','min:7', 'max:7'],
            'amount' => ['required', 'numeric','min:10'],
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

            'transaction_type.required' => __(':attribute have to select', ['attribute' => __('Transaction type')]),
            'transaction_type.numeric'  => __(':attribute field must be a number', ['attribute' => __('Transaction type')]),
            'transaction_type.min'      => __(':attribute have to select', ['attribute' => __('Transaction type')]),
            'transaction_type.max'      => __(':attribute have to select', ['attribute' => __('Transaction type')]),

            'account.required' => __('The :attribute have to select', ['attribute' => __('Account')]),
            'account.numeric'  => __(':attribute have to select', ['attribute' => __('Account')]),
            'account.exists'   => __('The selected :attribute id is invalid.', ['attribute' => __('Account')]),

            'amount.required' => __('The :attribute have to write', ['attribute' => __('Amount')]),
            'amount.numeric'  => __(':attribute field must be a number', ['attribute' => __('Amount')]),
            'amount.min'      => __('The :attribute have to be greater than or equal to  10', ['attribute' => __('Amount')]),
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
