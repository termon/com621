<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
       return [        
            'book_id' => ['required'],
            'user_id' => ['required'],           
            'rating' => ['required', 'numeric', 'min:0', 'max:5'],
            'comment' => ['required','min:5', 'max:1000'],
        ];
    }
}
