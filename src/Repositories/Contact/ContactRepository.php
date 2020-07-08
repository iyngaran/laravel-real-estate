<?php


namespace Iyngaran\RealEstate\Repositories\Contact;


use Illuminate\Pagination\LengthAwarePaginator;
use Iyngaran\RealEstate\Exceptions\ContactNotFoundException;
use Iyngaran\RealEstate\Models\Contact;

class ContactRepository implements ContactRepositoryInterface
{

    public function find(int $id): ?Contact
    {
        $contact = Contact::find($id);
        if (!$contact) {
            throw new ContactNotFoundException("The contact id # ".$id." not found");
        }
        return $contact;
    }

    public function findByEmail(string $emailAddress): ?Contact
    {
        $contact = Contact::where('email', $emailAddress)->first();;
        if (!$contact) {
            throw new ContactNotFoundException("The contact email # ".$emailAddress." not found");
        }
        return $contact;
    }

    public function search(array $query): LengthAwarePaginator
    {
        // TODO: Implement search() method.
    }
}