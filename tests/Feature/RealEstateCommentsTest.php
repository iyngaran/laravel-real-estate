<?php


namespace Iyngaran\RealEstate\Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Iyngaran\RealEstate\Actions\CreateCommentAction;
use Iyngaran\RealEstate\Actions\CreateContactAction;
use Iyngaran\RealEstate\DataTransferObjects\CommentData;
use Iyngaran\RealEstate\DataTransferObjects\ContactData;
use Iyngaran\RealEstate\Models\Contact;
use Iyngaran\RealEstate\Models\Owner;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Iyngaran\RealEstate\Tests\TestCase;

class RealEstateCommentsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test 
     */
    public function a_comment_can_be_added_by_a_user()
    {
        $faker = \Faker\Factory::create();
        $faker = \Faker\Factory::create();
        $realEstate = factory(RealEstatePost::class)->create();
        $user = $this->createUser();

        $data = [
            'comment' => $faker->sentence,
            'real-estate-post-id' => $realEstate->id
        ];

        $request = new \Illuminate\Http\Request($data);
        $commentsData = CommentData::fromRequest($request);

        $realestateComment = (new CreateCommentAction())->execute($commentsData, $user);
        dd($realestateComment);
        $this->assertEquals(1, \Actuallymab\LaravelComment\Models\Comment::count());
    }
}