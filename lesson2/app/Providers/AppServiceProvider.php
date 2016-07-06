<?php

namespace App\Providers;

use App\Lib\Application\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $smartphone = new Application();
        $this->app->instance('Application', $smartphone);
    }
}
