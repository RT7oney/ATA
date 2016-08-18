<?php

namespace Core\Providers;

use Core\Services\Request;
use Illuminate\Support\ServiceProvider;

class RequestServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Services\Request', function ($app) {
          return new Request($app);
      });
    }
}
