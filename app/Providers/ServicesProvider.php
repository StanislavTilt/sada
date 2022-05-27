<?php

namespace App\Providers;

use App\Services\CropImageService;
use App\Services\Interfaces\CropImageServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CropImageService::class, function (): CropImageServiceInterface {
            return new CropImageService(config('tinify.api_key'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
