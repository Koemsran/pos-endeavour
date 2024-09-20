<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends DefaultRequest
{
   
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'owner_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'payment_method' => 'required|in:paypal,stripe',
            'code' => 'nullable',
            'payment_date' => 'required',
            'currency' => 'required',
           
        ];
    }
}
