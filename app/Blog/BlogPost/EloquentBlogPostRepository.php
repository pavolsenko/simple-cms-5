<?php

namespace App\Blog\BlogPost;

use Illuminate\Contracts\Auth\Guard as Auth;

class EloquentBlogPostRepository implements BlogPostRepositoryInterface {

    const ENABLED = 1;
    const DISABLED = 0;
    const POSTS_PER_PAGE_BLOG = 10;
    const POSTS_PER_PAGE_ADMIN = 20;

    private $blogPost;
    private $auth;

    public function __construct(BlogPost $blogPost, Auth $auth) {
        $this->blogPost = $blogPost;
        $this->auth = $auth;
    }

    public function createBlogPost($input) {
        $this->blogPost->author_id = $input['author'];
        $this->blogPost->title = $input['title'];
        $this->blogPost->intro_text = $input['intro_text'];
        $this->blogPost->body_text = $input['body_text'];
        $this->blogPost->created_by = $this->auth->user()->getAuthIdentifier();
        $this->blogPost->updated_by = $this->auth->user()->getAuthIdentifier();
        $this->blogPost->enabled = self::ENABLED;
        $this->blogPost->url = $input['url'];
        $this->blogPost->meta_title = $input['meta_title'];
        $this->blogPost->meta_keywords = $input['meta_keywords'];
        $this->blogPost->meta_description = $input['meta_description'];
        $this->blogPost->save();
        $this->blogPost->categories()->attach($input['categories']);
        return $this->blogPost->toArray();
    }

    public function updateBlogPost($input) {
        $this->blogPost = $this->blogPost
            ->where('id', $input['id'])
            ->first();
        if (!is_null($this->blogPost)) {
            $this->blogPost->author_id = $input['author'];
            $this->blogPost->title = $input['title'];
            $this->blogPost->intro_text = $input['intro_text'];
            $this->blogPost->body_text = $input['body_text'];
            $this->blogPost->updated_by = $this->auth->user()->getAuthIdentifier();
            $this->blogPost->url = $input['url'];
            $this->blogPost->meta_title = $input['meta_title'];
            $this->blogPost->meta_keywords = $input['meta_keywords'];
            $this->blogPost->meta_description = $input['meta_description'];
            $this->blogPost->save();
            $this->blogPost->categories()->sync($input['categories']);
        }
        return $this->blogPost->toArray();
    }

    public function deleteBlogPost($id) {
        $this->blogPost = $this->blogPost
            ->where('id', $id)
            ->first();
        if (!is_null($this->blogPost)) {
            $this->blogPost->delete();
            return true;
        } else {
            return false;
        }
    }

    public function publishBlogPost($id) {
        $this->blogPost = $this->blogPost
            ->where('id', $id)
            ->first();
        if (!is_null($this->blogPost)) {
            $this->blogPost->enabled = self::ENABLED;
            $this->blogPost->save();
            return true;
        } else {
            return false;
        }
    }

    public function unpublishBlogPost($id) {
        $this->blogPost = $this->blogPost
            ->where('id', $id)
            ->first();
        if (!is_null($this->blogPost)) {
            $this->blogPost->enabled = self::DISABLED;
            $this->blogPost->save();
            return true;
        } else {
            return false;
        }
    }

    public function getBlogPostById($id) {
        $post = $this->blogPost
            ->where('id', $id)
            ->with([
                'author',
                'author.social',
                'comments',
                'comments.author',
                'categories'])
            ->first();
        if (!is_null($post)) {
            $post = $post->toArray();
        }
        return $post;
    }

    public function getBlogPostByAuthor($author) {

    }

    public function getAllBlogPosts($enabled_only=false) {
        if ($enabled_only) {
            $posts = $this->blogPost
                ->where('enabled', self::ENABLED)
                ->with([
                    'author',
                    'comments',
                    'categories'
                ])
                ->orderBy('created_at', 'desc')
                ->paginate(self::POSTS_PER_PAGE_BLOG);
        } else {
            $posts = $this->blogPost
                ->with([
                    'author',
                    'comments',
                    'categories'
                ])
                ->orderBy('created_at', 'desc')
                ->paginate(self::POSTS_PER_PAGE_ADMIN);
        }
        if (!is_null($posts)) {
            $posts = $posts->toArray();
        }
        return $posts;
    }

    public function getLatestPosts($number=5) {
        $posts = $this->blogPost
            ->with(['author'])
            ->where('enabled', self::ENABLED)
            ->orderBy('created_at', 'DESC')
            ->take($number)
            ->get();
        if (!is_null($posts)) {
            $posts = $posts->toArray();
        }
        return $posts;
    }

}
