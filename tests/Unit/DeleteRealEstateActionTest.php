<?php


namespace Iyngaran\RealEstate\Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Iyngaran\RealEstate\Actions\DeleteRealEstatePostAction;
use Iyngaran\RealEstate\Models\Contact;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Iyngaran\RealEstate\Models\Service;
use Iyngaran\RealEstate\Tests\TestCase;

class DeleteRealEstateActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test 
     */
    public function delete_real_estate_post_action_test()
    {
        $realEstate = factory(RealEstatePost::class)->create();
        $deleteRealEstatePost = (new DeleteRealEstatePostAction())->execute($realEstate->id);

        $this->assertTrue($deleteRealEstatePost);
        $this->assertEquals(0, RealEstatePost::count());
        $this->assertEquals(0, \DB::table('realestate_services')->where('realestate_post_id', $realEstate->id)->count());
    }
}