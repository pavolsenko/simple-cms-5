<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BlogCategoryServiceProvider extends ServiceProvider
{

    public function register() {
        \App::bind('App\Blog\BlogCategory\BlogCategoryRepositoryInterface', 'App\Blog\BlogCategory\EloquentBlogCategoryRepository');
    }

}
