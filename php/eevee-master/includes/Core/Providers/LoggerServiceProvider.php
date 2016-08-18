<?php

namespace Core\Providers;

use Core\Services\Logger;
use Illuminate\Support\ServiceProvider;

class LoggerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind('App\Services\Logger', function () {
          return new Logger();
      });
    }
}
