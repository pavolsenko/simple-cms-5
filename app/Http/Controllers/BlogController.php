<?php

namespace App\Http\Controllers;

use App\Blog\BlogService;
use Illuminate\Http\Request;
use Illuminate\View\Factory as View;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Factory as Validator;

/**
 * Class BlogController
 * @package App\Http\Controllers
 */
class BlogController extends Controller
{

    const NUMBER_OF_LATEST_POSTS = 5;
    const BLOG_ROOT_ID = 0;
    const BLOG_ROUTE_NAME = 'blog';
    const CATEGORY_ROUTE_NAME = 'blogCategory';

    private $blogService;
    protected $view;
    protected $request;
    private $redirector;
    private $validator;

    /**
     * BlogController constructor injecting dependencies.
     */
    public function __construct(BlogService $blogService, View $view, Request $request, Redirector $redirector, Validator $validator) {
        $this->blogService = $blogService;
        $this->view = $view;
        $this->request = $request;
        $this->redirector = $redirector;
        $this->validator = $validator;
    }

    /**
     * @param int $category_id
     * @param string $url
     *
     * @return $this|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function indexBlog($category_id=self::BLOG_ROOT_ID, $url=null) {

        // Resolve if we are in blog root or specific category
        // Resolve if we are on page 1 and redirect to avoid duplicate content (/blog/ equals /blog/?page=1)
        $page = $this->request->get('page');
        if ($category_id == self::BLOG_ROOT_ID) {
            if ($page == 1) {
                return $this->redirector->route(self::BLOG_ROUTE_NAME);
            } else {
                $category = null;
                $posts = $this->blogService->getBlogPostsForHomepage();
            }
        } else {
            $category = $this->blogService->getBlogCategoryById($category_id);
            if ($page == 1) {
                return $this->redirector->route(self::CATEGORY_ROUTE_NAME, ['id' => $category_id, 'url' => $category['url']]);
            } else {
                $posts = $this->blogService->getBlogPostsByCategory($category_id);
            }
        }

        // get categories and latest posts for right column
        $categories = $this->blogService->getBlogCategoriesForHomepage();
        $latest_posts = $this->blogService->getLatestPosts(self::NUMBER_OF_LATEST_POSTS);

        // if category does not exist or url is invalid return 404
        if ($category_id != self::BLOG_ROOT_ID && ($category == null || $category['url'] != $url)) {
            return $this->view
                ->make('errors/404', [], [404]);
        } else {
            return $this->view
                ->make('blog/homepage')
                ->with('category', $category)
                ->with('posts', $posts['data'])
                ->with('total_pages', $posts['last_page'])
                ->with('current_page', $posts['current_page'])
                ->with('categories', $categories)
                ->with('latest_posts', $latest_posts);
        }
    }

    /**
     * @return $this
     */
    public function indexAdmin() {
        $posts = $this->blogService->getBlogPostsForAdmin();

        return $this->view
            ->make('admin/blogPosts/dashboard')
            ->with('posts', $posts['data'])
            ->with('total_pages', $posts['last_page'])
            ->with('current_page', $posts['current_page']);
    }

    /**
     * @param null $id
     *
     * @return $this
     */
    public function getCreateOrUpdate($id=null) {
        if (!is_null($id)) {
            $blog_post = $this->blogService->getBlogPostById($id);
            if (!is_null($blog_post)) {
                $selected_categories = [];
                foreach ($blog_post['categories'] as $selected_category) {
                    array_push($selected_categories, $selected_category['id']);
                }
            } else {
                $selected_categories = null;
            }
        } else {
            $blog_post = null;
            $selected_categories = null;
        }
        $authors = $this->blogService->getAllAuthorsWithIds();
        $categories = $this->blogService->getAllCategoriesWithIds();
        return $this->view
            ->make('admin/blogPosts/createOrUpdate')
            ->with('blog_post', $blog_post)
            ->with('authors', $authors)
            ->with('categories', $categories)
            ->with('selected_categories', $selected_categories);
    }

    /**
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postCreateOrUpdate() {
        $input = $this->request->all();
        $rules = [
            'title' => 'required',
            'intro_text' => 'required',
            'body_text' => 'required',
            'author' => 'required|integer',
            'categories' => 'required'
        ];
        $this->validator = $this->validator->make($input, $rules);
        if ($this->validator->fails()) {
            return $this->redirector
                ->back()
                ->withInput()
                ->withErrors($this->validator);
        } else {
            $blog_post = $this->blogService->saveBlogPost($input);
            $message = trans('blog.saved');
            $authors = $this->blogService->getAllAuthorsWithIds();
            $categories = $this->blogService->getAllCategoriesWithIds();
            $selected_categories = [];
            foreach ($blog_post['categories'] as $selected_category) {
                array_push($selected_categories, $selected_category['id']);
            }
            if ($input['close']) {
                return $this->redirector
                    ->route('postsDashboard');
            } else {
                return $this->view
                    ->make('admin/blogPosts/createOrUpdate')
                    ->with('blog_post', $blog_post)
                    ->with('authors', $authors)
                    ->with('categories', $categories)
                    ->with('selected_categories', $selected_categories)
                    ->with('message', $message);
            }
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id) {
        $this->blogService->deleteBlogPost($id);
        $message = trans('blog.blog_post_deleted');

        return $this->redirector
            ->route('postsDashboard')
            ->with('message', $message);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getPublish($id) {
        $this->blogService->publishBlogPost($id);
        $message = trans('blog.blog_post_published');

        return $this->redirector
            ->route('postsDashboard')
            ->with('message', $message);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getUnpublish($id) {
        $this->blogService->unpublishBlogPost($id);
        $message = trans('blog.blog_post_unpublished');

        return $this->redirector
            ->route('postsDashboard')
            ->with('message', $message);
    }

    /**
     * @param $id
     * @param $url
     * @return $this|\Illuminate\Contracts\View\View
     */
    public function getBlogPost($id, $url) {
        $blog_post = $this->blogService->getBlogPostById($id);

        // if not found or url does not match return 404
        if (is_null($blog_post) || $blog_post['url'] != $url) {
            return $this->view
                ->make('errors/404', [], [404]);
        } else {
            // randomly select related posts
            $related_posts = $this->blogService->getRelatedBlogPosts($id, $blog_post['categories'][rand(0, count($blog_post['categories']) - 1)]['id']);

            // set meta tags otherwise global meta tags will be used
            $meta = $this->blogService->getMetaTags($blog_post);

            // get avatar urls from gravatar api
            foreach ($blog_post['comments'] as &$comment) {
                $comment['author']['avatar_url'] = $this->blogService->getAvatarUrl($comment['author']['email']);
            }

            return $this->view
                ->make('blog/singlePost')
                ->with('blog_post', $blog_post)
                ->with('related_posts', $related_posts)
                ->with('meta_author', $meta['author'])
                ->with('meta_description', $meta['description'])
                ->with('meta_keywords', $meta['keywords'])
                ->with('meta_title', $meta['title']);
        }
    }

    /**
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postComment() {
        $input = $this->request->all();
        $rules = array(
            'name' => 'required|min:3',
            'email' => 'required|email',
            'website' => 'url',
            'text' => 'required|min:3|max:500'
        );
        $this->validator = $this->validator->make($input, $rules);
        if ($this->validator->fails()) {
            return $this->redirector
                ->back()
                ->withErrors($this->validator)
                ->withInput();
        } else {
            $result = $this->blogService->postComment($input);
            if ($result) {
                $message = trans('comment.comment_submitted');
            } else {
                $message = trans('comment.comment_awaiting_approval');
            }
            return $this->redirector
                ->back()
                ->with('message', $message);
        }
    }

}
