<?php

namespace Core\Providers;

use Core\Services\Status;
use Illuminate\Support\ServiceProvider;

class StatusServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Services\Status', function ($app) {

          return new Status();
      });
    }
}
