<?php


namespace Iyngaran\RealEstate\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class PromotePackageRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data.attributes.package_name' => 'required',
            'data.attributes.short_description' => 'required',
            'data.attributes.detail_description' => 'required',
            'data.attributes.status' => 'required',
            'data.attributes.display_order' => 'required',
        ];
    }
}
