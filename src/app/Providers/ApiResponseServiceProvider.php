<?php

namespace HaiCS\Laravel\Api\Response\Providers;

use HaiCS\Laravel\Api\Response\Supports\ApiResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ApiResponseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('api', function () {
            return new ApiResponse();
        });
    }

    /**
     * Register any package services
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
