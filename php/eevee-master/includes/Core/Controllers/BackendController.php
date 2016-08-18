<?php

namespace Core\Controllers;

use Core\Services\Context;

class BackendController extends Controller
{

    public function getPlugin($name, Context $context)
    {

        ob_start();

        $view = base_path("content/plugins/$name/view.php");

        if (file_exists($view)) {

            include $view;
        }

        $content = ob_get_contents();

        ob_end_clean();


        return response(view('backend.layout', ['content' => $content]));

    }

    public function getLogin(Context $context)
    {

        return response(view('backend.login'));

    }

}