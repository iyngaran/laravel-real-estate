<?php


namespace Iyngaran\RealEstate\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class PromotePackageRequest extends FormRequest
{
    public function rules()
    {
        return [
            'package_name' => 'required',
            'short_description' => 'required',
            'detail_description' => 'required',
            'status' => 'required',
            'display_order' => 'required',
        ];
    }
}
