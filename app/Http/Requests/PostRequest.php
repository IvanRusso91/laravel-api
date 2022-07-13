<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required | max:255 | min:3',
            'content' => 'min:10'
        ];
    }

    public function messages(){
        return [
            'title.required'=> 'il campo title è obbligatorio',
            'title.max'=> 'il campo title deve avere al amssimo :max carratteri',
            'title.max'=> 'il campo title deve avere al amssimo :min carratteri ',

            'description.min' => 'la descrizione deve avere minimo :min caratteri'
        ];
    }
}
