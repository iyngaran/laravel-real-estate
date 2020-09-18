<?php


namespace Iyngaran\RealEstate\Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Iyngaran\RealEstate\DataTransferObjects\RealEstateData;
use Iyngaran\RealEstate\Models\Contact;
use Iyngaran\RealEstate\Models\Owner;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Iyngaran\RealEstate\Models\Service;
use Iyngaran\RealEstate\Tests\Models\User;
use Iyngaran\RealEstate\Tests\TestCase;

class RealEstateDataTransferTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function real_estate_data_transfer_test()
    {
        $user = factory(User::class)->create();
        $category = factory(\Iyngaran\Category\Models\Category::class)->create();
        $subCategory = factory(\Iyngaran\Category\Models\Category::class)->create();
        $services = factory(Service::class, 5)->create();
        $serviceIds = [];
        if ($services) {
            foreach ($services as $service) {
                array_push($serviceIds, $service->id);
            }
        }
        $size_unit = $this->faker->randomElement(config('iyngaran.realestate.size_units'));
        $age_unit = $this->faker->randomElement(config('iyngaran.realestate.duration_units'));
        $currency = $this->faker->randomElement(config('iyngaran.realestate.currencies'));

        $default_image = ['url' => 'test1.png', 'display_order' => 1];
        $images = [
            ['url' => 'test2.png', 'display_order' => 2],
            ['url' => 'test3.png', 'display_order' => 3]
        ];

        $data = [
            'title' => $this->faker->word(),
            'real_estate_for' => $this->faker->randomElement([RealEstatePost::FOR_RENT, RealEstatePost::FOR_SALE]),
            'condition' => $this->faker->randomElement([RealEstatePost::CONDITION_NEW, RealEstatePost::CONDITION_USED]),
            'short_description' => $this->faker->paragraph(1),
            'detail_description' => $this->faker->paragraph(3),
            'number_of_bedrooms' => $this->faker->randomNumber(1),
            'number_of_bathrooms' => $this->faker->randomNumber(1),
            'size' => [
                'size' => $this->faker->randomNumber(2),
                'unit' => $size_unit,
            ],
            'age' => [
                'age' => $this->faker->randomNumber(1),
                'unit' => $age_unit,
            ],
            'price' => [
                'price' => $this->faker->randomNumber(2),
                'unit' => $currency
            ],
            'min_lease_term' => [
                'term' => $this->faker->randomNumber(2),
                'unit' => $age_unit,
            ],
            'advanced_payment' => [
                'payment' => 200,
                'unit' => $currency
            ],
            'utility_bill_payments_included' => $this->faker->randomElement([RealEstatePost::YES, RealEstatePost::NO]),
            'negotiable' => $this->faker->randomElement([RealEstatePost::YES, RealEstatePost::NO]),
            'number_of_parking_slots' => $this->faker->randomNumber(2),
            'category' => [
                'id' => $category->id
            ],
            'sub_category' => [
                'id' => $subCategory->id
            ],
            'location' => [
                'country' => $this->faker->country,
                'state' => $this->faker->state,
                'city' => $this->faker->city,
                'address_line_1' => $this->faker->address,
                'address_line_2' => $this->faker->address,
                'coordinates' => [
                    'latitude' => $this->faker->randomFloat(),
                    'longitude' => $this->faker->randomFloat()
                ],
            ],
            'contact' => [
                'name' => $this->faker->firstName,
                'phone_numbers' => $this->faker->phoneNumber . "," . $this->faker->phoneNumber,
                'email' => $this->faker->email
            ],
            'service_ids' => $serviceIds,
            'defaultImage' => $default_image,
            'images' => $images,
            'user' => [
                'id' => $user->id
            ]
        ];

        $request = new \Illuminate\Http\Request($data);
        $realEstateData = RealEstateData::fromRequest($request);
        $this->assertArrayHasKey('title', $realEstateData);
    }

}
