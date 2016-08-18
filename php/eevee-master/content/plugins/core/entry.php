<?php

use Core\Services\Context;
use Illuminate\Support\Facades\DB;

global $app;

$app->get('/', function (Context $context) {

    function hello()
    {

        echo id();
    }

    hello();


});


$app->get('/hello', function (Context $context) {

    return $context->status('success', selector('app', $context->params()));

});
