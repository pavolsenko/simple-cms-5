<?php

namespace App\Blog\BlogCategory;

interface BlogCategoryRepositoryInterface {
    public function createBlogCategory($input);
    public function updateBlogCategory($input);
    public function deleteBlogCategory($id);
    public function publishBlogCategory($id);
    public function unpublishBlogCategory($id);
    public function getBlogPostsForCategory($id);
    public function getAllBlogCategories($enabled_only=false);
    public function getBlogCategoryById($id);
}