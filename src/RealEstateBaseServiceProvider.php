<?php

namespace Iyngaran\RealEstate;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Iyngaran\RealEstate\Facades\RealEstate;
use Iyngaran\RealEstate\Models\RealEstatePost;
use Iyngaran\RealEstate\Observers\RealEstatePostObserver;
use Iyngaran\RealEstate\Repositories\Contact\ContactRepository;
use Iyngaran\RealEstate\Repositories\Contact\ContactRepositoryInterface;
use Iyngaran\RealEstate\Repositories\RealEstate\RealEstateRepository;
use Iyngaran\RealEstate\Repositories\RealEstate\RealEstateRepositoryInterface;
use Iyngaran\RealEstate\Repositories\Service\ServiceRepository;
use Iyngaran\RealEstate\Repositories\Service\ServiceRepositoryInterface;

class RealEstateBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }

        $this->registerResources();
        $this->registerObservers();
    }

    public function register()
    {
        $this->registerRepositories();
        $this->commands(
            [
            Console\ProcessCommand::class
            ]
        );
    }

    private function registerResources()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadFactoriesFrom(__DIR__ . '/../database/factories');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'iyngaran.categories');

        $this->registerFacades();
        $this->registerWebRoutes();
        $this->registerApiRoutes();
    }

    private function registerWebRoutes()
    {
        Route::group(
            $this->webRouteConfiguration(),
            function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            }
        );
    }

    private function registerApiRoutes()
    {
        Route::group(
            $this->apiRouteConfiguration(),
            function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
            }
        );
    }

    private function webRouteConfiguration()
    {
        return  [
            'prefix' => RealEstate::path(),
            'middleware' => RealEstate::middleware(),
            'namespace' => 'Iyngaran\RealEstate\Http\Controllers'
        ];
    }

    private function apiRouteConfiguration()
    {
        return  [
            'prefix' => 'api/' . RealEstate::path(),
            'middleware' => RealEstate::middleware(),
            'namespace' => 'Iyngaran\RealEstate\Http\Controllers\Api'

        ];
    }

    protected function registerPublishing()
    {
        $this->publishes(
            [
            __DIR__ . "/../config/iyngaran.realestate.php" => config_path('iyngaran.realestate.php')
            ],
            'realestate-config'
        );

        $this->mergeConfigFrom(__DIR__ . "/../config/iyngaran.realestate.php", 'iyngaran.realestate');
    }

    private function registerFacades()
    {
        $this->app->singleton(
            'RealEstate',
            function ($app) {
                return new \Iyngaran\RealEstate\RealEstate();
            }
        );
    }

    private function registerRepositories()
    {
        $this->app->bind(RealEstateRepositoryInterface::class, RealEstateRepository::class);
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
    }

    private function registerObservers()
    {
        RealEstatePost::observe(RealEstatePostObserver::class);
    }
}
