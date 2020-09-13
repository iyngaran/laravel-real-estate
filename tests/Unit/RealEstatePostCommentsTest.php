<?php


namespace Iyngaran\RealEstate\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Iyngaran\RealEstate\Tests\Models\User;
use Iyngaran\RealEstate\Tests\TestCase;
use Config;

class RealEstatePostCommentsTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function setUp():void
    {
        parent::setUp();
    }


    /** @test */
    public function a_user_can_comment_on_RealEstatePost()
    {
        $user = $this->createUser();
        $post = factory(RealEstatePost::class)->create();
        $user->comment($post, $this->faker->sentence);
        $this->assertEquals(1, $post->comments()->count());

        $user->comment($post, $this->faker->sentence);
        $this->assertEquals(2, $post->comments()->count());
        $this->assertTrue($post->comments()->first()->commentable->is($post));
        $this->assertTrue($post->comments()->first()->commented->is($user));
    }

    /** @test */
    public function comment_can_be_checked()
    {
        $user = $this->createUser();
        $post = factory(RealEstatePost::class)->create();

        $user->comment($post, $this->faker->sentence);
        $this->assertTrue($user->hasCommentsOn($post));
    }

    /** @test */
    public function it_must_be_unapproved_as_default_if_must_be_approved_method_returns_true()
    {
        $user = $this->createUser();
        $post = factory(RealEstatePost::class)->create();

        $user->comment($post, $this->faker->sentence);
        $this->assertFalse($user->comments[0]->approved);
    }

    /** @test */
    public function it_can_be_approved()
    {
        $user = $this->createUser();
        $post = factory(RealEstatePost::class)->create();

        $user->comment($post, $this->faker->sentence);
        $this->assertFalse($post->comments[0]->approved);
        $user->comments[0]->approve();
        $this->assertTrue($post->comments[0]->fresh()->approved);
    }

    /** @test */
    public function it_can_calculate_total_approved_comments_count()
    {
        $user = $this->createUser();
        $post = factory(RealEstatePost::class)->create();

        $user->comment($post, $this->faker->sentence);
        $user->comment($post, $this->faker->sentence);
        $user->comment($post, $this->faker->sentence);

        $user->comments[0]->approve();
        $user->comments[2]->approve();


        $this->assertEquals(2, $post->totalCommentsCount());
        $this->assertEquals(3, $post->comments()->count());
    }

    /** @test */
    public function it_can_get_approved_comments()
    {
        $user = $this->createUser();
        $post = factory(RealEstatePost::class)->create();

        $user->comment($post, $this->faker->sentence);
        $user->comment($post, $this->faker->sentence);
        $user->comment($post, $this->faker->sentence);

        $user->comments[0]->approve();
        $user->comments[2]->approve();

        $this->assertEquals(2, $post->comments()->approvedComments()->get()->count());
    }

}