<?php


namespace Iyngaran\RealEstate\Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Iyngaran\RealEstate\Actions\CreateCommentAction;
use Iyngaran\RealEstate\Actions\MarkAsPublishedAction;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Iyngaran\RealEstate\Tests\TestCase;

class AddCommentOnRealEstateActionTest extends TestCase
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
    public function add_comment_on_real_estate_post_action_test()
    {
        $faker = \Faker\Factory::create();
        $realEstate = factory(RealEstatePost::class)->create();
        $user = $this->createUser();
        $commentsData = [
            'realEstatePost' => $realEstate,
            'comment' => $faker->sentence
        ];
        $realestateComment = (new CreateCommentAction())->execute($commentsData, $user);
        $this->assertEquals(1, \Actuallymab\LaravelComment\Models\Comment::count());
    }
}