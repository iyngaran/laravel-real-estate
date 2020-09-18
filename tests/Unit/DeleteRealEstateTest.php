<?php


namespace Iyngaran\RealEstate\Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Iyngaran\RealEstate\Models\RealEstatePost;
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
    public function delete_a_real_estate_post()
    {
        $real_estate = factory(\Iyngaran\RealEstate\Models\RealEstatePost::class)->create();
        $res = $real_estate->delete();
        $this->assertTrue($res);
        $this->assertEquals(0, RealEstatePost::count());
    }
}
