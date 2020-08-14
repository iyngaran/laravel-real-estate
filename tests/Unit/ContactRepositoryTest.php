<?php


namespace Iyngaran\RealEstate\Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Iyngaran\RealEstate\Exceptions\RealEstateNotFoundException;
use Iyngaran\RealEstate\Repositories\Contact\ContactRepositoryInterface;
use Iyngaran\RealEstate\Repositories\RealEstate\RealEstateRepositoryInterface;
use Iyngaran\RealEstate\Tests\TestCase;

class ContactRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test 
     */
    public function a_contact_can_be_retrieve_by_id()
    {
        $factory_contact = factory(\Iyngaran\RealEstate\Models\Contact::class)->create();
        $contactRepository = $this->app->make(ContactRepositoryInterface::class);
        $contact = $contactRepository->find($factory_contact->id);
        $this->assertEquals($factory_contact->id, $factory_contact->id);
        $this->assertEquals($factory_contact->name, $factory_contact->name);
        $this->assertEquals($factory_contact->email, $factory_contact->email);
        $this->assertEquals($factory_contact->created_at, $factory_contact->created_at);
        $this->assertEquals($factory_contact->updated_at, $factory_contact->updated_at);
    }

    /**
     * @test 
     */
    public function a_contact_can_be_retrieve_by_title()
    {
        $factory_contact = factory(\Iyngaran\RealEstate\Models\Contact::class)->create();
        $contactRepository = $this->app->make(ContactRepositoryInterface::class);
        $contact = $contactRepository->findByEmail($factory_contact->email);
        $this->assertEquals($factory_contact->id, $factory_contact->id);
        $this->assertEquals($factory_contact->name, $factory_contact->name);
        $this->assertEquals($factory_contact->email, $factory_contact->email);
        $this->assertEquals($factory_contact->created_at, $factory_contact->created_at);
        $this->assertEquals($factory_contact->updated_at, $factory_contact->updated_at);
    }

}