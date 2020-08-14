<?php


namespace Iyngaran\RealEstate\Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Iyngaran\RealEstate\Actions\MarkAsPublishedAction;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Iyngaran\RealEstate\Tests\TestCase;

class PublishRealEstateActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test 
     */
    public function publish_real_estate_post_action_test()
    {
        $realEstate = factory(RealEstatePost::class)->create();
        $publishedRealEstatePost = (new MarkAsPublishedAction())->execute($realEstate->id);

        $this->assertEquals('Published', $publishedRealEstatePost->status);
        $this->assertNotNull('Published', $publishedRealEstatePost->published_at);
    }
}