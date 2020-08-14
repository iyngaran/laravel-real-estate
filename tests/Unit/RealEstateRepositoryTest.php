<?php


namespace Iyngaran\RealEstate\Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Iyngaran\RealEstate\Exceptions\RealEstateNotFoundException;
use Iyngaran\RealEstate\Repositories\RealEstate\RealEstateRepositoryInterface;
use Iyngaran\RealEstate\Tests\TestCase;

class RealEstateRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test 
     */
    public function a_real_estate_can_be_retrieve_by_id()
    {
        $factory_real_estate = factory(\Iyngaran\RealEstate\Models\RealEstatePost::class)->create();
        $realEstateRepository = $this->app->make(RealEstateRepositoryInterface::class);
        $real_estate = $realEstateRepository->find($factory_real_estate->id);
        $this->assertEquals($factory_real_estate->id, $real_estate->id);
        $this->assertEquals($factory_real_estate->title, $real_estate->title);
        $this->assertEquals($factory_real_estate->created_at, $real_estate->created_at);
        $this->assertEquals($factory_real_estate->updated_at, $real_estate->updated_at);
    }

    /**
     * @test 
     */
    public function a_real_estate_can_be_retrieve_by_title()
    {
        $factory_real_estate = factory(\Iyngaran\RealEstate\Models\RealEstatePost::class)->create();
        $realEstateRepository = $this->app->make(RealEstateRepositoryInterface::class);
        $real_estate = $realEstateRepository->findByTitle($factory_real_estate->title);
        $this->assertEquals($factory_real_estate->id, $real_estate->id);
        $this->assertEquals($factory_real_estate->title, $real_estate->title);
        $this->assertEquals($factory_real_estate->created_at, $real_estate->created_at);
        $this->assertEquals($factory_real_estate->updated_at, $real_estate->updated_at);
    }

}