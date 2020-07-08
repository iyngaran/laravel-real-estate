<?php


namespace Iyngaran\RealEstate\Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Iyngaran\RealEstate\Actions\CreateContactAction;
use Iyngaran\RealEstate\Models\Contact;
use Iyngaran\RealEstate\Tests\TestCase;

class CreateContactActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test 
     */
    public function create_contact_action_test()
    {
        $faker = \Faker\Factory::create();

        $contactData = [
            'name' => $faker->firstName,
            'contactNumbers' => $faker->phoneNumber.",".$faker->phoneNumber,
            'email' => $faker->email
        ];

        $createContactAction =  new CreateContactAction();
        $contact = $createContactAction->execute($contactData);

        $this->assertNotNull($contact->id);
        $this->assertEquals(1, Contact::count());
    }

    /**
     * @test 
     */
    public function create_contact_with_existing_email_action_test()
    {
        $faker = \Faker\Factory::create();
        $contact = factory(\Iyngaran\RealEstate\Models\Contact::class)->create();

        $contactData = [
            'name' => $faker->firstName,
            'contactNumbers' => $faker->phoneNumber.",".$faker->phoneNumber,
            'email' => $contact->email
        ];

        $createContactAction =  new CreateContactAction();
        $contact = $createContactAction->execute($contactData);

        $this->assertNotNull($contact->id);
        $this->assertEquals(1, Contact::count());
    }
}