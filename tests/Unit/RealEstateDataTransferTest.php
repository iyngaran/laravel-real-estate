<?php


namespace Iyngaran\RealEstate\Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Iyngaran\RealEstate\DataTransferObjects\ContactData;
use Iyngaran\RealEstate\DataTransferObjects\RealEstateData;
use Iyngaran\RealEstate\Models\Contact;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Iyngaran\RealEstate\Models\Service;
use Iyngaran\RealEstate\Tests\TestCase;

class RealEstateDataTransferTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test 
     */
    public function real_estate_data_transfer_test()
    {
        $faker = \Faker\Factory::create();
        $contact = factory(Contact::class)->create();
        $services = factory(Service::class, 5)->create();
        $category = factory(\Iyngaran\Category\Models\Category::class)->create();
        $subCategory = factory(\Iyngaran\Category\Models\Category::class)->create();


        $data = [
            'data' => [
                'attributes' => [
                    'title' => $faker->word(),
                    'title' => $faker->word(),
                    'real_estate_for' => $faker->randomElement([RealEstatePost::FOR_RENT,RealEstatePost::FOR_SALE]),
                    'condition' => $faker->randomElement([RealEstatePost::CONDITION_NEW,RealEstatePost::CONDITION_USED]),
                    'short_description' => $faker->paragraph(1),
                    'detail_description' => $faker->paragraph(3),
                    'number_of_bedrooms' => $faker->randomNumber(1),
                    'number_of_bathrooms' => $faker->randomNumber(1),
                    'size' => $faker->randomNumber(2),
                    'age' => $faker->randomNumber(1),
                    'rent' => $faker->randomNumber(2),
                    'min_lease_term' => $faker->randomNumber(2),
                    'advanced_payment_unit' => $faker->randomElement(
                        [
                        RealEstatePost::ADVANCED_PAYMENT_UNIT_MONTHS,
                        RealEstatePost::ADVANCED_PAYMENT_UNIT_YEARS,
                        RealEstatePost::ADVANCED_PAYMENT_UNIT_AMOUNT
                        ]
                    ),
                    'advanced_payment' => $faker->randomNumber(5),
                    'utility_bill_payments_included' => $faker->randomElement([RealEstatePost::YES,RealEstatePost::NO]),
                    'negotiable' => $faker->randomElement([RealEstatePost::YES,RealEstatePost::NO]),
                    'number_of_parking_slots' => $faker->randomNumber(2),
                    'category_id' => $category->id,
                    'sub_category_id' => $subCategory->id,
                    'location' => [
                        'country' => $faker->country,
                        'state' => $faker->state,
                        'city' => $faker->city,
                        'address_line_1' => $faker->address,
                        'address_line_2' => $faker->address,
                        'coordinates' => [
                            'latitude' => $faker->randomFloat(),
                            'longitude' => $faker->randomFloat()
                        ],
                    ],
                    'contact' => [
                        'name' => $faker->firstName,
                        'phone_numbers' => $faker->phoneNumber.",".$faker->phoneNumber,
                        'email' => $faker->email
                    ]
                ]
            ]
        ];

        $request = new \Illuminate\Http\Request($data);
        $realEstateData = RealEstateData::fromRequest($request);
        $this->assertArrayHasKey('title', $realEstateData);
    }

}