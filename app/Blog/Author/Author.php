<?php

namespace App\Blog\Author;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'author';

    public function social() {
        return $this->hasMany('App\Blog\Author\SocialProfile', 'author_id');
    }
}
