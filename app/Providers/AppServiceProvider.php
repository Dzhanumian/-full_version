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
        $this->app->bind(
            'App\Http\Services\Lesson\iWorkedLesson',  
            'App\Http\Services\Lesson\WorkedLesson'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->app->bind(
        //     'App\Http\Controllers\Services\Lesson\iWorkedLesson',  
        //     'App\Http\Controllers\Services\Lesson\WorkedLesson'
        // );
    }
}
