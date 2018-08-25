<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AuthorServiceProvider extends ServiceProvider
{

    public function register() {
        \App::bind('App\Blog\Author\AuthorRepositoryInterface', 'App\Blog\Author\EloquentAuthorRepository');
    }

}
