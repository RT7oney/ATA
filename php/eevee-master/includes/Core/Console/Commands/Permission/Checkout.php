<?php

namespace Core\Console\Commands\Permission;

use Illuminate\Console\Command;

class Checkout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:checkout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'checkout permissions to find invalid permissions.';


    protected $routes;

    public function __construct()
    {
        parent::__construct();

        $this->routes = config('routes');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      print_r($this->routes);
    }
}
