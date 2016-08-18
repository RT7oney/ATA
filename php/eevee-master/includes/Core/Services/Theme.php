<?php

namespace Core\Services;

use Core\Http\Controllers\Controller;

class Theme extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function api($uri)
    {
        return $this->request->api($uri);
    }

    public function view($path){

    }

    public function asset($path){

    }

}
