<?php

if ($page = get_query('page')) {

    $file = __DIR__ . "/templates/$page.template.php";
    
    if (file_exists($file)) {

        include_once $file;

    } else {

        include_once 'templates/404.template.php';

    }

}