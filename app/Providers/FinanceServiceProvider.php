<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FinanceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Services\Finance\FinanceInterface',  
            'App\Http\Services\Finance\FinanceServices'
        );
    }

    public function boot()
    {

    }
}
