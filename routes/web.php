<?php



use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Api\ApiPaymentController;





    Route::any('/{path}', function () {
        return view('layouts.vue');
     })->where('path', '(.*)');
