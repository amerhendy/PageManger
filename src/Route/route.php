<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Route::group([
    'namespace'  =>config('Amer.PageManger.Controllers','\\Amerhendy\PageManger\App\Http\Controllers\\'),
    'prefix'     =>config('Amer.PageManger.route_prefix','PageManger'),
    'middleware' =>array_merge((array) config('Amer.Amer.web_middleware'),(array) config('Amer.Security.auth.middleware_key')),
    'name'=>config('Amer.PageManger.routeName_prefix','PageManger'),
], function () {
    Route::Amer('Pages','PagesAmerController');
});
