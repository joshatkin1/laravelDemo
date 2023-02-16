<?php

namespace App\Providers;

use App\Interfaces\ApiClient;
use App\Models\Client as Client;
use App\Services\FoodApi;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\TelescopeServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return ClientModel
     */
    public function register()
    {
        $this->app->bind(ApiClient::class, fn($app) => new FoodApi(new Client()));

        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //WHILE USING OCTANE/SWOOLE, THIS WILL BOOT THE SAME INSTANCE INTO THE REQUEST
        //FOR THE ENTIRE SESSION LIFECYCLE (USE WITH CARE)
    }
}
