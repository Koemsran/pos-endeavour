<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends DefaultRequest
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
            'field_id' => 'required|exists:fields,id', 
            'booking_date' => 'required|date', 
            'start_time' => 'required', 
            'end_time' => 'required', 
            'total_price' => 'required', 
            'status' => 'required|string', 
            'payment_status' => 'required|string', 
            'options' => 'array',
            'options.*.id' => 'required|exists:options,id',
            'options.*.qty' => 'nullable|integer|min:1',

        ];
    }
}
