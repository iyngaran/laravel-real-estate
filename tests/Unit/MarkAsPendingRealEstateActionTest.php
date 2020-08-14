<?php


namespace Iyngaran\RealEstate\Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Iyngaran\RealEstate\Actions\MarkAsDraftedAction;
use Iyngaran\RealEstate\Actions\MarkAsPendingAction;
use Iyngaran\RealEstate\Actions\MarkAsPublishedAction;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Iyngaran\RealEstate\Tests\TestCase;

class MarkAsPendingRealEstateActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test 
     */
    public function mark_as_pending_real_estate_post_action_test()
    {
        $realEstate = factory(RealEstatePost::class)->create();
        $publishedRealEstatePost = (new MarkAsPendingAction())->execute($realEstate->id);

        $this->assertEquals('Pending', $publishedRealEstatePost->status);
        $this->assertNotNull('Published');
    }
}