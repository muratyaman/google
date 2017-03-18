<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\GoogleService;

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
        $this->app->singleton('services.google', function($app){
            $google = new GoogleService(
                config('services.google.auth_file'),
                config('services.google.api_key')
            );
            return $google;
        });
    }
}
