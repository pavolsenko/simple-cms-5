<?php

namespace App\Blog\BlogCategory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BlogCategory extends Model
{
    use SoftDeletes;

    protected $table = 'blog_category';

    public function posts() {
        return $this->belongsToMany('App\Blog\BlogPost\BlogPost', 'blog_post_blog_category');
    }

}

