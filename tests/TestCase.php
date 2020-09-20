<?php


namespace Iyngaran\RealEstate\Tests;

use Illuminate\Support\Facades\Config;
use Iyngaran\Category\CategoryBaseServiceProvider;
use Iyngaran\RealEstate\RealEstateBaseServiceProvider;
use Iyngaran\RealEstate\Tests\Models\User;
use LamaLama\Wishlist\WishlistServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Config::set('comment.model', \Actuallymab\LaravelComment\Models\Comment::class);
        $this->setUpDatabase();
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
            RealEstateBaseServiceProvider::class,
            WishlistServiceProvider::class
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
            'database.connections.testdb',
            [
                'driver' => 'sqlite',
                'database' => ':memory:'
            ]
        );
    }


    private function setUpDatabase(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/resources/database/migrations');
    }

    protected function createUser(bool $isAdmin = false): User
    {
        return User::create(['name' => $this->faker->name, 'is_admin' => $isAdmin]);
    }
}
