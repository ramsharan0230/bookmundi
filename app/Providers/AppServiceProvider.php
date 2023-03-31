<?php

namespace App\Providers;

use App\Helpers\ResponseHelper;
use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('ResponseHandling', function ($data = null, $message, $responseCode) {
            $response = new ResponseHelper();
            return $response->responseHandling($data, $message, $responseCode);
        });
    }
}
