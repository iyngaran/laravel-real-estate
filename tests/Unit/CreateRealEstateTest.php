<?php


namespace Iyngaran\RealEstate\Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Iyngaran\RealEstate\Models\Contact;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Iyngaran\RealEstate\Models\Service;
use Iyngaran\RealEstate\Tests\TestCase;

class CreateRealEstateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test 
     */
    public function create_a_real_estate_post()
    {
        $faker = \Faker\Factory::create();
        $contact = factory(Contact::class)->create();
        $services = factory(Service::class, 5)->create();
        factory(\Iyngaran\Category\Models\Category::class)->create();
        $subCategory = factory(\Iyngaran\Category\Models\Category::class)->create();


        $real_estate = RealEstatePost::create(
            [
                'title' => $faker->word(),
                'real_estate_for' => $faker->randomElement([RealEstatePost::FOR_RENT,RealEstatePost::FOR_SALE]),
                'condition' => $faker->randomElement([RealEstatePost::CONDITION_NEW,RealEstatePost::CONDITION_USED]),
                'location_country' => $faker->country,
                'location_state' => $faker->state,
                'location_city' => $faker->city,
                'location_address_line_1' => $faker->address,
                'location_address_line_2' => $faker->address,
                'location_coordinates' => $faker->randomFloat().",".$faker->randomFloat(),
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
                'property_category' => $subCategory->parent_id,
                'property_sub_category' => $subCategory->id,
                'contact_id' => $contact->id
            ]
        );

        $real_estate->services()->attach($services);
        $this->assertEquals(1, RealEstatePost::count());
        $this->assertEquals($subCategory->parent_id, $real_estate->property_category);
        $this->assertEquals($subCategory->id, $real_estate->property_sub_category);
        $this->assertEquals(5, $real_estate->services->count());
    }
}