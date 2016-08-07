<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend(
            'password',
            function($attribute, $value, $parameters, $validator) {
                return \Hash::check( $value, \Auth::user()->password);
            });

        Validator::replacer('password', function($message, $attribute, $rule, $parameters) {
            return 'Your password is incorrect.';
        });
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
