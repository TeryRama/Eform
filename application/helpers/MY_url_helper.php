<?php

/**
 * Redirect to previous page if http referer is set. Otherwise to server root.
 */

if (!function_exists('redirect_back')) {
    function redirect_back()
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            header('Location: http://' . $_SERVER['SERVER_NAME']);
        }
        exit;
    }
}

if (!function_exists('myip')) {
    function myip()
    {
        $ci = get_instance();
        $ip = $ci->input->ip_address();
        if ($ip == MY_IP) {
            return true;
        } else {
            return false;
        }
    }
}
