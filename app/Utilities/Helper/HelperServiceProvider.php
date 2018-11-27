<?php namespace App\Utilities\Helper;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('helper', 'App\Utilities\Helper\Helper');
    }
}
