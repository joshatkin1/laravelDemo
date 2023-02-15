<?php

namespace App\Providers;

use App\Models\Client;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\TelescopeServiceProvider;
use App\Interfaces\ApiClient;
use App\Services\ApiClient as ApiService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ApiClient::class, function ($app) {

            /** THIS WOULD BE MODIFIED TO INSTANTIATE A SPECIFIC API CLIENT
             * BY PASSING IN CLIENT_ID INTO CONSTRUCTOR
             */
            return new ApiService(new Client());
        });

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
