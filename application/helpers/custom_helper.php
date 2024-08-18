<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists('session_get')) {
    function session_get($value)
    {
        $CI = get_instance();
        $session_val = $CI->session->userdata($value);
        return $session_val;
    }
}