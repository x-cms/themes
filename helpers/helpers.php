<?php

if (!function_exists('theme_base_path')) {
    /**
     * @param string $path
     * @return string
     */
    function theme_base_path($path = '')
    {
        $themeDirectory = config('themes.paths.absolute');

        return $themeDirectory . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}
