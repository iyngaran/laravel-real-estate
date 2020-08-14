<?php


namespace Iyngaran\RealEstate\Actions;


use Illuminate\Support\Facades\App;
use Iyngaran\RealEstate\Exceptions\ContactNotFoundException;
use Iyngaran\RealEstate\Models\Contact;
use Iyngaran\RealEstate\Repositories\Contact\ContactRepositoryInterface;

class CreateContactAction
{

    public function execute(array $attributes, $owner) : Contact
    {
        try {
            return App::make(ContactRepositoryInterface::class)->findByEmail($attributes['email']);
        } catch (ContactNotFoundException $ex) {
            return $owner->contact()->create(
                [
                    'name' => $attributes['name'],
                    'contact_numbers' => $attributes['contactNumbers'],
                    'email' => $attributes['email']
                ]
            );
        }
    }
}