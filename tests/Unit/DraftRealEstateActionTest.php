<?php


namespace Iyngaran\RealEstate\Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Iyngaran\RealEstate\Actions\MarkAsDraftedAction;
use Iyngaran\RealEstate\Actions\MarkAsPublishedAction;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Iyngaran\RealEstate\Tests\TestCase;

class DraftRealEstateActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test 
     */
    public function draft_real_estate_post_action_test()
    {
        $realEstate = factory(RealEstatePost::class)->create();
        $publishedRealEstatePost = (new MarkAsDraftedAction())->execute($realEstate->id);

        $this->assertEquals('Drafted', $publishedRealEstatePost->status);
        $this->assertNotNull('Published');
    }
}