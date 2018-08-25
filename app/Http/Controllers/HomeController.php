<?php

namespace App\Http\Controllers;

use App\Blog\BlogService;
use Illuminate\Contracts\View\Factory as View;

class homeController extends Controller
{

    protected $view;
    protected $blogPostService;

    public function __construct(View $view, BlogService $blogPostService) {
        $this->view = $view;
        $this->blogPostService = $blogPostService;
    }


    public function index() {
        $blog_posts = $this->blogPostService->getBlogPostsForHomepage();
        return $this->view->make('home')->with('blog_posts', $blog_posts);
    }

}
