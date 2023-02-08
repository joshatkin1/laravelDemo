<?php

namespace App\Providers;

use App\Services\Session;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\TelescopeServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {


        #THIS WILL RETURN THE EXACT SAME INSTANCE THROUGHOUT THE LIFECYCLE OF AN ENTIRE SESSION
        #WHILE COUPLED WITH THE BOOT CODE app('session') (example purposes)
        $this->app->singleton('session', function ($app) {
            return new Session();
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
        #THIS REGISTERS THE SESSION SERVICES AS A SINGLETON
        #FOR THE ENTIRE LIFETIME OF A USERS SESSION (for example purposes)
        app('session');
    }
}
