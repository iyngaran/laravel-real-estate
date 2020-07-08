<?php


namespace Iyngaran\RealEstate\Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Iyngaran\RealEstate\Actions\CreateRealEstatePostAction;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Iyngaran\RealEstate\Models\Service;
use Iyngaran\RealEstate\Tests\TestCase;

class CreateRealEstatePostActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test 
     */
    public function create_real_estate_post_action_test()
    {
        $faker = \Faker\Factory::create();
        $contact = factory(\Iyngaran\RealEstate\Models\Contact::class)->create();
        $services = factory(Service::class, 5)->create();
        $category = factory(\Iyngaran\Category\Models\Category::class)->create();
        $subCategory = factory(\Iyngaran\Category\Models\Category::class)->create();

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
            'age' => $faker->randomNumber(1),
            'rent' => $faker->randomNumber(2),
            'minLeaseTerm' => $faker->randomNumber(2),
            'advancedPaymentUnit' => $faker->randomElement(
                [
                RealEstatePost::ADVANCED_PAYMENT_UNIT_MONTHS,
                RealEstatePost::ADVANCED_PAYMENT_UNIT_YEARS,
                RealEstatePost::ADVANCED_PAYMENT_UNIT_AMOUNT
                ]
            ),
            'advancedPayment' => $faker->randomNumber(5),
            'utilityBillPaymentsIncluded' => $faker->randomElement([RealEstatePost::YES,RealEstatePost::NO]),
            'negotiable' => $faker->randomElement([RealEstatePost::YES,RealEstatePost::NO]),
            'numberOfParkingSlots' => $faker->randomNumber(2),
            'contact' => $contact,
            'category' => $category,
            'subCategory' => $subCategory,
            'services' => $services,

        ];

        $createRealEstatePostAction =  new CreateRealEstatePostAction();
        $realEstatePost = $createRealEstatePostAction->execute($realEstatePostData);
        $this->assertNotNull($realEstatePost->id);
        $this->assertEquals(1, RealEstatePost::count());
    }
}