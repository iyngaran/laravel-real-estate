<?php


namespace Iyngaran\RealEstate;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Iyngaran\RealEstate\Facades\RealEstate;
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

        $this->_registerResources();
    }

    public function register()
    {
        $this->_registerRepositories();
        $this->commands(
            [
            Console\ProcessCommand::class
            ]
        );
    }

    private function _registerResources()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadFactoriesFrom(__DIR__.'/../database/factories');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'iyngaran.categories');

        $this->_registerFacades();
        $this->_registerWebRoutes();
        $this->_registerApiRoutes();
    }

    private function _registerWebRoutes()
    {
        Route::group(
            $this->_webRouteConfiguration(), function () {
                $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
            }
        );
    }

    private function _registerApiRoutes()
    {
        Route::group(
            $this->_apiRouteConfiguration(), function () {
                $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
            }
        );
    }

    private function _webRouteConfiguration()
    {
        return  [
            'prefix' => RealEstate::path(),
            'middleware' => RealEstate::middleware(),
            'namespace' => 'Iyngaran\RealEstate\Http\Controllers'
        ];
    }

    private function _apiRouteConfiguration()
    {
        return  [
            'prefix' => 'api/'.RealEstate::path(),
            'middleware' => RealEstate::middleware(),
            'namespace' => 'Iyngaran\RealEstate\Http\Controllers\Api'

        ];
    }

    protected function registerPublishing()
    {
        $this->publishes(
            [
            __DIR__."/../config/iyngaran.realestate.php" => config_path('iyngaran.realestate.php')
            ], 'realestate-config'
        );
    }

    private function _registerFacades()
    {
        $this->app->singleton(
            'RealEstate', function ($app) {
                return new \Iyngaran\RealEstate\RealEstate();
            }
        );
    }

    private function _registerRepositories()
    {
        $this->app->bind(RealEstateRepositoryInterface::class, RealEstateRepository::class);
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
    }
}