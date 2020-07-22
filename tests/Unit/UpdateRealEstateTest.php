<?php


namespace Iyngaran\RealEstate\Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Iyngaran\RealEstate\Models\Contact;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Iyngaran\RealEstate\Models\Service;
use Iyngaran\RealEstate\Tests\TestCase;

class UpdateRealEstateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test 
     */
    public function update_a_real_estate_post()
    {
        $faker = \Faker\Factory::create();
        $contact = factory(Contact::class)->create();
        $services = factory(Service::class, 5)->create();
        factory(\Iyngaran\Category\Models\Category::class)->create();

        $subCategory = factory(\Iyngaran\Category\Models\Category::class)->create();
        $real_estate = factory(\Iyngaran\RealEstate\Models\RealEstatePost::class)->create();

        $size_unit = $faker->randomElement(['Perches', 'Acres', 'Square Metres', 'Square Feet', 'Square yards', 'Hectare']);
        $age_unit = $faker->randomElement(['Months', 'Years']);
        $currency = $faker->randomElement(['LKR' => 'RS', 'USD' => '$']);

        $real_estate->update(
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
                'size_unit' => $size_unit,
                'age' => $faker->randomNumber(1),
                'age_unit' => $age_unit,
                'rent' => $faker->randomNumber(2),
                'rent_unit' => $age_unit,
                'min_lease_term' => $faker->randomNumber(2),
                'min_lease_term_unit' => $age_unit,
                'advanced_payment' => $faker->randomNumber(5),
                'advanced_payment_unit' => $currency,
                'utility_bill_payments_included' => $faker->randomElement([RealEstatePost::YES,RealEstatePost::NO]),
                'negotiable' => $faker->randomElement([RealEstatePost::YES,RealEstatePost::NO]),
                'number_of_parking_slots' => $faker->randomNumber(2),
                'property_category' => $subCategory->parent_id,
                'property_sub_category' => $subCategory->id,
                'contact_id' => $contact->id,
                'status' => $faker->randomElement(['Published','Drafted','Pending']),
            ]
        );

        $serviceIds = $services->pluck('id');
        $real_estate->services()->sync($serviceIds);
        $this->assertEquals(1, RealEstatePost::count());
        $this->assertEquals($subCategory->parent_id, $real_estate->property_category);
        $this->assertEquals($subCategory->id, $real_estate->property_sub_category);
        $this->assertEquals(5, $real_estate->services->count());
    }
}