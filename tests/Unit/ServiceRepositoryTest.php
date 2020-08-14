<?php


namespace Iyngaran\RealEstate\Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Iyngaran\RealEstate\Exceptions\RealEstateNotFoundException;
use Iyngaran\RealEstate\Repositories\Contact\ContactRepositoryInterface;
use Iyngaran\RealEstate\Repositories\RealEstate\RealEstateRepositoryInterface;
use Iyngaran\RealEstate\Tests\TestCase;
use Iyngaran\RealEstate\Repositories\Service\ServiceRepositoryInterface;

class ServiceRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test 
     */
    public function a_service_can_be_retrieve_by_id()
    {
        $factory_service = factory(\Iyngaran\RealEstate\Models\Service::class)->create();
        $serviceRepository = $this->app->make(ServiceRepositoryInterface::class);
        $service = $serviceRepository->find($factory_service->id);
        $this->assertEquals($service->id, $factory_service->id);
        $this->assertEquals($service->name, $factory_service->name);
        $this->assertEquals($service->created_at, $factory_service->created_at);
        $this->assertEquals($service->updated_at, $factory_service->updated_at);
    }

    /**
     * @test 
     */
    public function a_service_can_be_retrieve_by_name()
    {
        $factory_service = factory(\Iyngaran\RealEstate\Models\Service::class)->create();
        $serviceRepository = $this->app->make(ServiceRepositoryInterface::class);
        $services = $serviceRepository->findByName($factory_service->name);
        foreach($services as $service) {
            $this->assertEquals($service->id, $factory_service->id);
            $this->assertEquals($service->name, $factory_service->name);
            $this->assertEquals($service->created_at, $factory_service->created_at);
            $this->assertEquals($service->updated_at, $factory_service->updated_at);
        }

    }


    /**
     * @test
     */
    public function a_service_list_can_be_retrieve()
    {
        factory(\Iyngaran\RealEstate\Models\Service::class, 5)->create();
        $serviceRepository = $this->app->make(ServiceRepositoryInterface::class);
        $services = $serviceRepository->getAll();
        $this->assertEquals(5, $services->count());
    }
}