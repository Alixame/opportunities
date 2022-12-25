<?php

namespace Alixame\Opportunities;

use Illuminate\Support\ServiceProvider;

class OpportunitiesServiceProvider extends ServiceProvider 
{
    public function boot()
    {
        // $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');

        // $this->loadViewsFrom(__DIR__.'/resources/views', 'view');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {

    }
}