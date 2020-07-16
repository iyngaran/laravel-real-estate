<?php


namespace Iyngaran\RealEstate\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RealEstatePostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data.attributes.title' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'data.attributes.name.title' => 'The title field is required'
        ];
    }
}