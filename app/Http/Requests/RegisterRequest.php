<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends DefaultRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    // public function rules(): array
    // {
    //         $rules = [
    //             'name'     => 'required|string|max:255',
    //             'email'    => 'required|string|email|max:255|unique:users',
    //             'password' => 'required|string|min:8',
    //             'qr' => 'nullable',
    //         ];
    //         return $rules;

    // }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|string|max:20',
            'qr' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ];
    }
}
