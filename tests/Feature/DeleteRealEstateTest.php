<?php


namespace Iyngaran\RealEstate\Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Iyngaran\RealEstate\Actions\DeleteRealEstatePostAction;
use Iyngaran\RealEstate\Actions\UpdateRealEstatePostAction;
use Iyngaran\RealEstate\DataTransferObjects\RealEstateData;
use Iyngaran\RealEstate\Models\Contact;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Iyngaran\RealEstate\Models\Service;
use Iyngaran\RealEstate\Tests\TestCase;

class DeleteRealEstateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test 
     */
    public function a_real_estate_can_be_deleted()
    {
        $faker = \Faker\Factory::create();
        $factoryRealEstatePost = factory(RealEstatePost::class)->create();


        $data = [
            'data' => [
                'attributes' => [
                    'id' => $factoryRealEstatePost->id,
                ]
            ]
        ];

        $request = new \Illuminate\Http\Request($data);
        $id = $request['data']['attributes']['id'];
        $deleteRealEstatePost = (new DeleteRealEstatePostAction())->execute($id);

        $this->assertTrue($deleteRealEstatePost);
        $this->assertEquals(0, RealEstatePost::count());
        $this->assertEquals(0, \DB::table('realestate_services')->where('realestate_post_id', $id)->count());
    }
}