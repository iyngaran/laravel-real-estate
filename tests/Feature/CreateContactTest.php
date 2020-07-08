<?php


namespace Iyngaran\RealEstate\Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Iyngaran\RealEstate\Actions\CreateContactAction;
use Iyngaran\RealEstate\DataTransferObjects\ContactData;
use Iyngaran\RealEstate\Models\Contact;
use Iyngaran\RealEstate\Tests\TestCase;

class CreateContactTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test 
     */
    public function a_contact_can_be_created()
    {
        $faker = \Faker\Factory::create();

        $data = [
            'data' => [
                'attributes' => [
                    'contact' => [
                        'name' => $faker->firstName,
                        'phone_numbers' => $faker->phoneNumber.",".$faker->phoneNumber,
                        'email' => $faker->email
                    ]
                ]
            ]
        ];

        $request = new \Illuminate\Http\Request($data);
        $contactData = ContactData::fromRequest($request);

        $createContactAction =  new CreateContactAction();
        $contact = $createContactAction->execute($contactData);

        $this->assertNotNull($contact->id);
        $this->assertEquals(1, Contact::count());
    }
}