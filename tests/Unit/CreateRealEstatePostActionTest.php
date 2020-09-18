<?php


namespace Iyngaran\RealEstate\Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Iyngaran\RealEstate\Actions\CreateRealEstatePostAction;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Iyngaran\RealEstate\Models\Service;
use Iyngaran\RealEstate\Tests\Models\User;
use Iyngaran\RealEstate\Tests\TestCase;

class CreateRealEstatePostActionTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function create_real_estate_post_action_test()
    {
        $user = factory(User::class)->create();
        $services = factory(Service::class, 5)->create();

        $category = factory(\Iyngaran\Category\Models\Category::class)->create();
        $subCategory = factory(\Iyngaran\Category\Models\Category::class)->create();
        $size_unit = $this->faker->randomElement(config('iyngaran.realestate.size_units'));
        $age_unit = $this->faker->randomElement(config('iyngaran.realestate.duration_units'));
        $currency = $this->faker->randomElement(config('iyngaran.realestate.currencies'));

        $default_image = ['url' => 'test1.png', 'display_order' => 1];
        $images = [
            ['url' => 'test2.png', 'display_order' => 2],
            ['url' => 'test3.png', 'display_order' => 3]
        ];

        $realEstatePostData = [
            'title' => $this->faker->word(),
            'realEstateFor' => $this->faker->randomElement([RealEstatePost::FOR_RENT, RealEstatePost::FOR_SALE]),
            'condition' => $this->faker->randomElement([RealEstatePost::CONDITION_NEW, RealEstatePost::CONDITION_USED]),
            'country' => $this->faker->country,
            'state' => $this->faker->state,
            'city' => $this->faker->city,
            'addressLine_1' => $this->faker->address,
            'addressLine_2' => $this->faker->address,
            'coordinates' => $this->faker->randomFloat() . "," . $this->faker->randomFloat(),
            'shortDescription' => $this->faker->paragraph(1),
            'detailDescription' => $this->faker->paragraph(3),
            'numberOfBedrooms' => $this->faker->randomNumber(1),
            'numberOfBathrooms' => $this->faker->randomNumber(1),
            'size' => $this->faker->randomNumber(2),
            'sizeUnit' => $size_unit,
            'age' => $this->faker->randomNumber(1),
            'ageUnit' => $age_unit,
            'price' => $this->faker->randomNumber(2),
            'priceUnit' => $currency,
            'minLeaseTerm' => $this->faker->randomNumber(2),
            'minLeaseTermUnit' => $age_unit,
            'advancedPayment' => $this->faker->randomNumber(5),
            'advancedPaymentUnit' => $currency,
            'utilityBillPaymentsIncluded' => $this->faker->randomElement([RealEstatePost::YES, RealEstatePost::NO]),
            'negotiable' => $this->faker->randomElement([RealEstatePost::YES, RealEstatePost::NO]),
            'numberOfParkingSlots' => $this->faker->randomNumber(2),
            'category' => $category,
            'subCategory' => $subCategory,
            'services' => $services,
            'status' => $this->faker->randomElement(config('iyngaran.realestate.status')),
            'defaultImage' => $default_image,
            'images' => $images
        ];

        $createRealEstatePostAction = new CreateRealEstatePostAction();
        $realEstatePost = $createRealEstatePostAction->execute($realEstatePostData, $user);

        $this->assertNotNull($realEstatePost->id);
        $this->assertEquals(1, RealEstatePost::count());
        $this->assertEquals($category->name, $realEstatePost->category->name);
        $this->assertEquals($category->id, $realEstatePost->property_category);
        $this->assertEquals($subCategory->name, $realEstatePost->subCategory->name);
        $this->assertEquals($subCategory->id, $realEstatePost->property_sub_category);
        $this->assertEquals(
            5,
            \DB::table('realestate_services')->where('realestate_post_id', $realEstatePost->id)->count()
        );
        $this->assertEquals($default_image['url'], $realEstatePost->defaultImage->url);
        $this->assertEquals(3, $realEstatePost->images->count());
        $this->assertEquals($user->id, $realEstatePost->user_id);
    }
}
