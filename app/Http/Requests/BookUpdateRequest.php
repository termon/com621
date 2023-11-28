<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
{

    // after form is validated update the validator image value to the base64 file contents
    protected function passedValidation(): void 
    {     
        if ($this->hasFile('image')) { 
            $file = $this->image;
            $image = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file));
            //$this->validator->setData([...$this->validator->getData(), 'image' => $image]);  // works 
            $this->validator->setValue('image', $image);  // works 
        } 
    }
    
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
            //'id' => ['required'], // as this is an update we require id so it can be used in validating title uniqueness
            'title' => ['required',Rule::unique('books')->ignore($this->id)], // or $this->input('id')
            'year' => ['required', 'numeric', 'min:2000', 'max:2024'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['min:0', 'max:1000'],          
            'image' => ['nullable', File::types(['png', 'jpg'])->max(12 * 1024),],
            'authors.*' => ['nullable']
        ];
    }
}
