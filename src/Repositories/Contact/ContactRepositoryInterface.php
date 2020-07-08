<?php


namespace Iyngaran\RealEstate\Repositories\Contact;


use Iyngaran\RealEstate\Models\Contact;
use Illuminate\Pagination\LengthAwarePaginator;

interface ContactRepositoryInterface
{
    public function find(int $id): ? Contact;
    public function findByEmail(string $emailAddress): ? Contact;
    public function search(array $query): LengthAwarePaginator;
}