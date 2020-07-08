<?php


namespace Iyngaran\RealEstate\DataTransferObjects;

use \Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class ContactData extends DataTransferObject
{
    /**
     * @var string|null
     */
    public $name;

    /**
     * @var string|null
     */
    public $contactNumbers;

    /**
     * @var string|null
     */
    public $email;


    public static function fromRequest(Request $request): array
    {
        return  (
            new self(
                [
                'name' => ucfirst($request->input('data.attributes.contact.name')),
                'contactNumbers' => $request->input('data.attributes.contact.phone_numbers'),
                'email' => $request->input('data.attributes.contact.email'),
                ]
            )
        )->toArray();
    }


}