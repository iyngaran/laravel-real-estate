<?php


namespace Iyngaran\RealEstate\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RealEstatePostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'title.required' => 'The title field is required'
        ];
    }
}
