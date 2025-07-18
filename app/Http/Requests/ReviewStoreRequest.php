<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewStoreRequest extends FormRequest
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
        return [
            // 1. Uma review deve conter uma nota de 0 a 5
            'rating' => 'required|numeric|min:0|max:5',
            'text' => 'required|string|max:1024',
            'user_id' => 'required|exists:users2,id',
            'book_id' => 'required|exists:books,id',
        ];
    }
}
