<?php


namespace Iyngaran\RealEstate\Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Iyngaran\RealEstate\DataTransferObjects\CommentData;
use Iyngaran\RealEstate\DataTransferObjects\ContactData;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Iyngaran\RealEstate\Tests\TestCase;

class CommentsDataTransferTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test 
     */
    public function comment_data_transfer_test()
    {
        $faker = \Faker\Factory::create();
        $post = factory(RealEstatePost::class)->create();

        $data = [
            'comment' => $faker->sentence,
            'real-estate-post-id' => $post->id
        ];

        $request = new \Illuminate\Http\Request($data);
        $commentsData = CommentData::fromRequest($request);
        $this->assertArrayHasKey('comment', $commentsData);
        $this->assertArrayHasKey('realEstatePost', $commentsData);
    }

}