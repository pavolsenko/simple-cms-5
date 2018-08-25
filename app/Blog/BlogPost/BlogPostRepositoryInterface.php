<?php

namespace App\Blog\BlogPost;

interface BlogPostRepositoryInterface {
    public function createBlogPost($input);
    public function updateBlogPost($input);
    public function deleteBlogPost($id);
    public function publishBlogPost($id);
    public function unpublishBlogPost($id);
    public function getBlogPostById($id);
    public function getBlogPostByAuthor($author);
    public function getAllBlogPosts($enabled_only=false);
    public function getLatestPosts($number=5);
}