<?php


namespace Iyngaran\RealEstate\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data.attributes.name' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'data.attributes.name.required' => 'The name field is required'
        ];
    }
}