<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::extend('algorithm', function ($attribute, $value) {
            $rotation = "([ULFRBD]w?|[MESxyz])[2']?";
            return preg_match("/^$rotation( $rotation)*$/u", $value);
        }, 'The :attribute format is invalid');

        if (\App::environment(['production'])) {
            \URL::forceScheme('https');
        }
    }
}
