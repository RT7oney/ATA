<?php

namespace Core\Services;

use Illuminate\Http\Request;

//use Symfony\Component\HttpFoundation\Request;

class Http
{

    /**
     * Creates a Request based on a given URI and configuration.
     *
     * The information contained in the URI always take precedence
     * over the other information (server and parameters).
     *
     * @param string $uri The URI
     * @param string $method The HTTP method
     * @param array $parameters The query (GET) or request (POST) parameters
     * @param array $cookies The request cookies ($_COOKIE)
     * @param array $files The request files ($_FILES)
     * @param array $server The server parameters ($_SERVER)
     * @param string $content The raw body data
     *
     * @return Request A Request instance
     */
    public static function request($uri, $method = 'GET', $parameters = array(), $cookies = array(), $files = array(), $server = array(), $content = null)
    {
        global $app;

        $request = Request::create($uri, $method, $parameters, $cookies, $files, $server, $content);

        return $app->run($request);
    }

}
