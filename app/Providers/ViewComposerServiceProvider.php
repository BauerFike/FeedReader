<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Feed;
use App\Category;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeNavbar();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function composeNavbar():void
    {
        view()->composer('components.navbar', function ($view) {
            $view->with('feeds', Feed::all());
            $view->with('categories', Category::all());
        });
    }
}
