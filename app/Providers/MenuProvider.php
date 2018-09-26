<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class MenuProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer("afrique.index", function($view)
        {
            $view->with('categories', Category::all());
        });

        View::composer("afrique.article", function($view)
        {
            $view->with('categories', Category::all());
        });

        View::composer("afrique.categorie", function($view)
        {
            $view->with('categories', Category::all());
        });

        View::composer("afrique.recherche", function($view)
        {
            $view->with('categories', Category::all());
        });
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
}
