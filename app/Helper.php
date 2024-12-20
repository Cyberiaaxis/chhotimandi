<?php

use Illuminate\Support\Facades\Route;

/**
 * @param $path
 * @param string $active
 * @return string
 */
if (!function_exists('set_active')) {
    /**
     *  Set Active Menu
     *
     * @param $path
     * @param string $active
     * @param boolean $boolean
     * @return string
     */
    function set_active($path, $active = 'active', $boolean = false)
    {

        if (Route::is($path)) {

            if ($boolean) {
                return true;
            }

            return $active;
        }

        return (request()->is($path)) ? $active : '';
    }
}
