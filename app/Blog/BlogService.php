<?php namespace App\Blog;

use App\Blog\BlogPost\BlogPostRepositoryInterface;
use App\Blog\BlogCategory\BlogCategoryRepositoryInterface;
use App\Blog\Author\AuthorRepositoryInterface;
use App\Blog\Comment\CommentRepositoryInterface;
use Illuminate\Contracts\Config\Repository as Config;
use App\Tools\SeoTools;

/**
 * Class BlogService
 * @package App\Blog
 */
class BlogService {

    const ENABLED_ONLY = true;
    const NUMBER_OF_RELATED_POSTS = 5;

    private $blogPostRepository;
    private $blogCategoryRepository;
    private $authorRepository;
    private $commentRepository;
    private $seoTools;
    private $config;

    /**
     * BlogService constructor injecting dependencies.
     */
    public function __construct(
        BlogPostRepositoryInterface $blogPostRepositoryInterface,
        BlogCategoryRepositoryInterface $blogCategoryRepositoryInterface,
        AuthorRepositoryInterface $authorRepositoryInterface,
        CommentRepositoryInterface $commentRepositoryInterface,
        SeoTools $seoTools,
        Config $config
    ) {
        $this->blogPostRepository = $blogPostRepositoryInterface;
        $this->blogCategoryRepository = $blogCategoryRepositoryInterface;
        $this->authorRepository = $authorRepositoryInterface;
        $this->commentRepository = $commentRepositoryInterface;
        $this->seoTools = $seoTools;
        $this->config = $config;
    }

    /**
     * gets all blog posts for frontend from repository
     *
     * @return array
     */
    public function getBlogPostsForHomepage() {
        $posts = $this->blogPostRepository->getAllBlogPosts(self::ENABLED_ONLY);
        return $posts;
    }

    /**
     * gets all blog post for backend from repository
     *
     * @return array
     */
    public function getBlogPostsForAdmin() {
        return $this->blogPostRepository->getAllBlogPosts();
    }

    /**
     * Gets blog posts for frontend for specific category
     *
     * @param $category_id
     * @return array
     */
    public function getBlogPostsByCategory($category_id) {
        return $this->blogCategoryRepository->getBlogPostsForCategory($category_id);
    }

    /**
     * @return array
     */
    public function getBlogCategoriesForHomepage() {
        return $this->blogCategoryRepository->getAllBlogCategories(self::ENABLED_ONLY);
    }

    /**
     * @return mixed
     */
    public function getBlogCategoriesForAdmin() {
        return $this->blogCategoryRepository->getAllBlogCategories();
    }

    /**
     * @param $id
     * @return array
     */
    public function getBlogPostById($id) {
        $post = $this->blogPostRepository->getBlogPostById($id);
        return $post;
    }

    /**
     * Saves blog post
     *
     * @param $input array
     * @return array
     */
    public function saveBlogPost($input) {
        if (empty($input['url'])) {
            $input['url'] = $this->seoTools->createNiceUrl($input['title']);
        } else {
            $input['url'] = $this->seoTools->createNiceUrl($input['url']);
        }
        if (isset($input['id'])) {
            $blog_post = $this->blogPostRepository->updateBlogPost($input);
        } else {
            $blog_post = $this->blogPostRepository->createBlogPost($input);
        }
        return $this->blogPostRepository->getBlogPostById($blog_post['id']);
    }

    /**
     * Deletes blog post by given ID
     *
     * @param $id
     *
     * @return array
     */
    public function deleteBlogPost($id) {
        return $this->blogPostRepository->deleteBlogPost($id);
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function publishBlogPost($id) {
        return $this->blogPostRepository->publishBlogPost($id);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function unpublishBlogPost($id) {
        return $this->blogPostRepository->unpublishBlogPost($id);
    }

    /**
     * @param $input
     *
     * @return mixed
     */
    public function postComment($input) {
        $result = $this->commentRepository->createComment($input);
        return $result;
    }

    /**
     * Gets latest posts from repository
     *
     * @param $count
     *
     * @return array
     */
    public function getLatestPosts($count) {
        return $this->blogPostRepository
            ->getLatestPosts($count);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function getBlogCategoryById($id) {
        return $this->blogCategoryRepository->getBlogCategoryById($id);
    }

    /**
     * Gets number of random related posts from repository based on post and category
     *
     * @param int $post_id
     * @param int $category_id
     * @param int $number
     *
     * @return array
     */
    public function getRelatedBlogPosts($post_id, $category_id, $number=self::NUMBER_OF_RELATED_POSTS) {
        $posts = $this->getBlogPostsByCategory($category_id);
        $result = [];
        for ($ii = 0; $ii < $number; $ii++) {
            $post_key = rand(0, count($posts['data']));
            if (!is_null($posts['data']) && isset($posts['data'][$post_key])) {
                if ($posts['data'][$post_key]['id'] != $post_id) {
                    array_push($result, $posts['data'][$post_key]);
                    unset($posts['data'][$post_key]);
                }
            }
        }
        return $result;
    }

    /**
     * Returns array of authors from repository as associated array of their IDs
     *
     * @return array
     */
    public function getAllAuthorsWithIds() {
        $authors = $this->authorRepository->getAllAuthors();
        $result = [];
        if (!empty($authors)) {
            foreach ($authors as $author) {
                $result[$author['id']] = $author['first_name'].' '.$author['last_name'];
            }
        }
        return $result;
    }


    /**
     * Returns array of categories from repository as associated array of their IDs
     *
     * @return array
     */
    public function getAllCategoriesWithIds() {
        $categories = $this->blogCategoryRepository->getAllBlogCategories();
        $result = [];
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $result[$category['id']] = $category['title'];
            }
        }
        return $result;
    }

    /**
     * Sets meta tag for provided item (blog post or page)
     *
     * @param array $item
     *
     * @return array
     */
    public function getMetaTags($item) {

        // Setting up default values from ENV configuration file
        $meta = [
            'author' => $this->config->get('app.meta_author'),
            'description' => $this->config->get('app.meta_description'),
            'keywords' => $this->config->get('app.meta_keywords'),
            'title' => $this->config->get('app.meta_title'),
        ];

        // Set author only if it's set (pages has no author) and not empty
        if (isset($item['author'])) {
            if (!empty($item['author'])) {
                $meta['author'] = $item['author']['first_name'] . ' ' . $item['author']['last_name'];
            }
        }

        // Override default meta title <title> only if it's not empty
        if (!empty($item['meta_title'])) {
            $meta['title'] = $item['meta_title'];
        } else {
            $meta['title'] = $item['title'];
        }

        // Override default meta description only if it's not empty
        if (!empty($item['meta_description'])) {
            $meta['description'] = $item['meta_description'];
        } else {
            if (isset($item['intro_text'])) {
                $meta['description'] = substr(strip_tags($item['intro_text']), 0, 200) . '...';
            }
        }

        // Override default meta keywords only if it's not empty
        if (isset($item['meta_keywords'])) {
            $meta['keywords'] = $item['meta_keywords'];
        }

        return $meta;
    }

    /**
     * Returns Gravatar URL for given email
     *
     * @param string $email
     *
     * @return string
     */
    public function getAvatarUrl($email) {
        $url = '//www.gravatar.com/avatar/'.md5(strtolower(trim($email))).'?d=identicon';
        return $url;
    }
}
