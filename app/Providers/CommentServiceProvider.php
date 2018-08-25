<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{

    public function register() {
        \App::bind('App\Blog\Comment\CommentRepositoryInterface', 'App\Blog\Comment\EloquentCommentRepository');
    }

}
