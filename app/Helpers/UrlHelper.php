<?php

defined('_APP_PATH_') or exit('You shall not pass!');


if (!function_exists('redirect_in_site')) {

    function redirect_in_site($path)
    {
        if (str_start_with($path, '/') && strlen($path) > 1) {
            $uri = _APP_CONTEXT_ . $path;
        } elseif (!str_start_with($path, '/')) {
            $uri = _APP_CONTEXT_ . '/' . $path;
        } else {
            $uri = _APP_CONTEXT_;
        }
        if (empty($uri)) {
            error_503();
            exit();
        }
        if (str_start_with($uri, '/')) {
            $uri = substr($uri, 1);
        }
        redirect($uri);
    }

}