<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BlogPostServiceProvider extends ServiceProvider
{

    public function register() {
        \App::bind('App\Blog\BlogPost\BlogPostRepositoryInterface', 'App\Blog\BlogPost\EloquentBlogPostRepository');
    }

}
