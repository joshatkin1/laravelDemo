<?php

namespace App\Providers;

use App\Interfaces\Api as ApiInterface;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\TelescopeServiceProvider;
use App\Services\Api;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(ApiInterface::class, fn($app) => Api::class);

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
