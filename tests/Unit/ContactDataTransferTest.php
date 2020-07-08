<?php


namespace Iyngaran\RealEstate\Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Iyngaran\RealEstate\DataTransferObjects\ContactData;
use Iyngaran\RealEstate\Tests\TestCase;

class ContactDataTransferTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test 
     */
    public function contact_data_transfer_test()
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
        $this->assertArrayHasKey('name', $contactData);
        $this->assertArrayHasKey('contactNumbers', $contactData);
        $this->assertArrayHasKey('email', $contactData);
    }

}