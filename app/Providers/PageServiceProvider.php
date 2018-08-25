<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PageServiceProvider extends ServiceProvider
{

    public function register() {
        \App::bind('App\Blog\Page\PageRepositoryInterface', 'App\Blog\Page\EloquentPageRepository');
    }

}
