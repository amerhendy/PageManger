<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler;
if (! function_exists('PageManger_url')) {
    function PageManger_url($path = null, $parameters = [], $secure = null)
    {
        $path = ! $path || (substr($path, 0, 1) == '/') ? $path : '/'.$path;
        return url(config('Amer.PageManger.routeName_prefix', 'PageManger').$path, $parameters, $secure);
    }
}
?>
