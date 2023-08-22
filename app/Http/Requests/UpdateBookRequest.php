<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'id' => ['required'], // as this is an update we require id so it can be used in validating title uniqueness
            'title' => ['required',Rule::unique('books')->ignore($this->id)], // or $this->input('id')
            'author' => 'required',
            'year' => ['required', 'numeric', 'min:2000', 'max:2024'],
            'rating' => ['required', 'numeric', 'min:0', 'max:5'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['min:0', 'max:1000'],
        ];
    }
}
