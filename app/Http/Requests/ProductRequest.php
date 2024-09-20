<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
   public function authorize()
    {
        return true; // Adjust based on your authentication logic
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust max file size if needed
            'category_id' => 'nullable|exists:categories,id',
            'color_ids' => 'nullable|array',
            'color_ids.*' => 'exists:colors,id',
            'size_ids' => 'nullable|array',
            'size_ids.*' => 'exists:sizes,id',
        ];
    }
}
