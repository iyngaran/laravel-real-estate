<?php


namespace Iyngaran\RealEstate\Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Iyngaran\RealEstate\Actions\CreateRealEstatePostAction;
use Iyngaran\RealEstate\DataTransferObjects\RealEstateData;
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
    public function a_real_estate_can_be_created()
    {
        $faker = \Faker\Factory::create();
        $contact = factory(Contact::class)->create();
        $services = factory(Service::class, 5)->create();
        $serviceIds = [];
        if ($services) {
            foreach($services as $service) {
                array_push($serviceIds, ['id'=>$service->id]);
            }
        }

        $category = factory(\Iyngaran\Category\Models\Category::class)->create();
        $subCategory = factory(\Iyngaran\Category\Models\Category::class)->create();

        $size_unit = $faker->randomElement(['Perches', 'Acres', 'Square Metres', 'Square Feet', 'Square yards', 'Hectare']);
        $age_unit = $faker->randomElement(['Months', 'Years']);
        $currency = $faker->randomElement(['LKR' => 'RS', 'USD' => '$']);

        $data = [
            'data' => [
                'attributes' => [
                    'title' => $faker->word(),
                    'real_estate_for' => factory(\Iyngaran\Category\Models\Category::class)->create(),
                    'condition' => $faker->randomElement([RealEstatePost::CONDITION_NEW,RealEstatePost::CONDITION_USED]),
                    'short_description' => $faker->paragraph(1),
                    'detail_description' => $faker->paragraph(3),
                    'number_of_bedrooms' => $faker->randomNumber(1),
                    'number_of_bathrooms' => $faker->randomNumber(1),
                    'size' => [
                        'size' => $faker->randomNumber(2),
                        'unit' => $size_unit,
                    ],
                    'age' => [
                        'age' => $faker->randomNumber(1),
                        'unit' => $age_unit,
                    ],
                    'rent' => [
                        'rent' => $faker->randomNumber(2),
                        'unit' => $currency
                    ],
                    'min_lease_term' => [
                        'term' => $faker->randomNumber(2),
                        'unit' => $age_unit,
                    ],
                    'advanced_payment' => [
                        'payment' => 200,
                        'unit' => $currency
                    ],
                    'utility_bill_payments_included' => $faker->randomElement([RealEstatePost::YES,RealEstatePost::NO]),
                    'negotiable' => $faker->randomElement([RealEstatePost::YES,RealEstatePost::NO]),
                    'number_of_parking_slots' => $faker->randomNumber(2),
                    'category' => [
                        'id' => $category->id
                    ],
                    'sub_category' => [
                        'id' => $subCategory->id
                    ],
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
                    ],
                    'service' => [
                        'ids' => $serviceIds
                    ]
                ]
            ]
        ];

        $request = new \Illuminate\Http\Request($data);
        $realEstateData = RealEstateData::fromRequest($request);

        $createRealEstatePostAction =  new CreateRealEstatePostAction();
        $realEstate = $createRealEstatePostAction->execute($realEstateData);

        $this->assertNotNull($realEstate->id);
        $this->assertEquals(1, RealEstatePost::count());
        $this->assertEquals(5,$realEstate->services->count());
        $this->assertEquals(5,Service::count());

        $this->assertEquals(
            [
                'id' => $services[0]->id,
                'name' => $services[0]->name,
                'created_at' => $services[0]->created_at
            ]
            ,
            [
                'id' => $realEstate->services[0]->id,
                'name' => $realEstate->services[0]->name,
                'created_at' => $realEstate->services[0]->created_at
            ]
        );


        $this->assertEquals(
            [
                'id' => $services[1]->id,
                'name' => $services[1]->name,
                'created_at' => $services[1]->created_at
            ]
            ,
            [
                'id' => $realEstate->services[1]->id,
                'name' => $realEstate->services[1]->name,
                'created_at' => $realEstate->services[1]->created_at
            ]
        );

    }
}