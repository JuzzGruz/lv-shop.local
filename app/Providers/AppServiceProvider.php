<?php

namespace App\Providers;

use App\Helpers\ActionImgHelper;
use App\View\Composers\AdminCountComposer;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\PublicComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('actionimg', ActionImgHelper::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('layouts.site', PublicComposer::class);
        view()->composer('layouts.adminPanel', AdminCountComposer::class);
    }
}
