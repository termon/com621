<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
{

    protected function prepareForValidation(): void
    {
        $file = $this->files->get('imagefile');        
        if ($file) {             
            $image = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file)); 
            $this->merge(['image' => $image ]); 
        }
    }
   
    // public function after(): array
    // { 
    //     return []; 
    // }

    // protected function passedValidation(): void 
    // {  
    //     // doesnt work     
    //     $this->replace(['imagefile' => null, 'title' => Str::lower($this->title)]);  
    // }

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
            'title' => ['required','unique:books'],
            'year' => ['required', 'numeric', 'min:2000', 'max:2024'],
            //'rating' => ['required', 'numeric', 'min:0', 'max:5'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['min:0', 'max:1000'],
            'image' => ['nullable'],
            'imagefile' => ['nullable', File::types(['png', 'jpg'])->max(1024),],
            'authors.*' => ['nullable']
        ];
    }
}
