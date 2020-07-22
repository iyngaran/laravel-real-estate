<?php


namespace Iyngaran\RealEstate\Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Iyngaran\RealEstate\Actions\CreateRealEstatePostAction;
use Iyngaran\RealEstate\Actions\UpdateRealEstatePostAction;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Iyngaran\RealEstate\Models\Service;
use Iyngaran\RealEstate\Tests\TestCase;

class UpdateRealEstatePostActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test 
     */
    public function update_real_estate_post_action_test()
    {
        $faker = \Faker\Factory::create();
        $factoryRealEstatePost = factory(\Iyngaran\RealEstate\Models\RealEstatePost::class)->create();
        $contact = factory(\Iyngaran\RealEstate\Models\Contact::class)->create();
        $services = factory(Service::class, 5)->create();

        $category = factory(\Iyngaran\Category\Models\Category::class)->create();
        $subCategory = factory(\Iyngaran\Category\Models\Category::class)->create();

        $size_unit = $faker->randomElement(['Perches', 'Acres', 'Square Metres', 'Square Feet', 'Square yards', 'Hectare']);
        $age_unit = $faker->randomElement(['Months', 'Years']);
        $currency = $faker->randomElement(['LKR' => 'RS', 'USD' => '$']);

        $realEstatePostData = [
            'title' => $faker->word(),
            'realEstateFor' => $faker->randomElement([RealEstatePost::FOR_RENT,RealEstatePost::FOR_SALE]),
            'condition' => $faker->randomElement([RealEstatePost::CONDITION_NEW,RealEstatePost::CONDITION_USED]),
            'country' => $faker->country,
            'state' => $faker->state,
            'city' => $faker->city,
            'addressLine_1' => $faker->address,
            'addressLine_2' => $faker->address,
            'coordinates' => $faker->randomFloat().",".$faker->randomFloat(),
            'shortDescription' => $faker->paragraph(1),
            'detailDescription' => $faker->paragraph(3),
            'numberOfBedrooms' => $faker->randomNumber(1),
            'numberOfBathrooms' => $faker->randomNumber(1),
            'size' => $faker->randomNumber(2),
            'sizeUnit' => $size_unit,
            'age' => $faker->randomNumber(1),
            'ageUnit' => $age_unit,
            'rent' => $faker->randomNumber(2),
            'rentUnit' => $currency,
            'minLeaseTerm' => $faker->randomNumber(2),
            'minLeaseTermUnit' => $age_unit,
            'advancedPayment' => $faker->randomNumber(5),
            'advancedPaymentUnit' => $currency,
            'utilityBillPaymentsIncluded' => $faker->randomElement([RealEstatePost::YES,RealEstatePost::NO]),
            'negotiable' => $faker->randomElement([RealEstatePost::YES,RealEstatePost::NO]),
            'numberOfParkingSlots' => $faker->randomNumber(2),
            'contact' => $contact,
            'category' => $category,
            'subCategory' => $subCategory,
            'services' => $services,
            'status' => $faker->randomElement(['Published','Drafted','Pending']),
        ];

        $updateRealEstatePostAction =  new UpdateRealEstatePostAction();
        $updatedRealEstatePost = $updateRealEstatePostAction->execute($realEstatePostData,$factoryRealEstatePost->id);
        $realEstatePost = $updatedRealEstatePost;
        $this->assertNotNull($realEstatePost->id);
        $this->assertEquals(1, RealEstatePost::count());
        $this->assertEquals($category->name, $realEstatePost->category->name);
        $this->assertEquals($category->id, $realEstatePost->property_category);
        $this->assertEquals($subCategory->name, $realEstatePost->subCategory->name);
        $this->assertEquals($subCategory->id, $realEstatePost->property_sub_category);
        $this->assertEquals(5, \DB::table('realestate_services')->where('realestate_post_id', $realEstatePost->id)->count());

    }
}