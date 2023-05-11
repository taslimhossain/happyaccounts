<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;

class StoreOtherTransactionRequest extends FormRequest
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
        return [
            'project_id'        => ['required','numeric','exists:projects,id'],
            'account'           => ['required','numeric','exists:bankings,id'],
            'expenses_cateogry' => ['required','numeric','exists:expenses_categories,id'],
            'transaction_type'  => ['required', 'numeric','min:10','max:10'],
            'amount'            => ['required', 'numeric','min:10'],
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
            'project_id.required' => __('The :attribute field is required', ['attribute' => __('Project')]),
            'project_id.numeric'  => __(':attribute id must be a number', ['attribute' => __('Project')]),
            'project_id.exists'   => __('The selected :attribute id is invalid.', ['attribute' => __('Project')]),

            'transaction_type.required' => __('The :attribute have to select', ['attribute' => __('Transaction type')]),
            'transaction_type.numeric'  => __(':attribute field must be a number', ['attribute' => __('Transaction type')]),
            'transaction_type.min'      => __('The :attribute have to select', ['attribute' => __('Transaction type')]),

            'expenses_cateogry.required' => __('The :attribute have to select', ['attribute' => __('Expenses cateogry')]),
            'expenses_cateogry.numeric'  => __(':attribute field must be a number', ['attribute' => __('Expenses cateogry')]),
            'expenses_cateogry.min'      => __('The :attribute have to select', ['attribute' => __('Expenses cateogry')]),

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
