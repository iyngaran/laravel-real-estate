<?php


namespace Iyngaran\RealEstate\Tests;

use Iyngaran\Category\CategoryBaseServiceProvider;
use Iyngaran\RealEstate\RealEstateBaseServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            CategoryBaseServiceProvider::class,
            RealEstateBaseServiceProvider::class
        ];
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);
        $app['config']->set('database.default', 'testdb');
        $app['config']->set(
            'database.connections.testdb', [
            'driver' => 'sqlite',
            'database' => ':memory:'
            ]
        );

    }
}