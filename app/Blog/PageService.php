<?php namespace App\Blog;

use App\Tools\SeoTools;
use Illuminate\Contracts\Config\Repository as Config;
use App\Blog\Page\PageRepositoryInterface;


/**
 * Class BlogService
 * @package App\Blog
 */
class PageService {

    private $pageRepository;
    private $seoTools;
    private $config;

    /**
     * PageService constructor injecting dependencies.
     */
    public function __construct(
        PageRepositoryInterface $pageRepository,
        SeoTools $seoTools,
        Config $config
    ) {
        $this->pageRepository = $pageRepository;
        $this->seoTools = $seoTools;
        $this->config = $config;
    }

    /**
     * Gets all pages for backend administration from repository
     *
     * @return array collection of pages converted to an array
     */
    public function getAllPages() {
        return $this->pageRepository->getAllPages();
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getPageById($id) {
        $post = $this->pageRepository->getPageById($id);
        return $post;
    }

    /**
     * @param $input array
     * @return array
     */
    public function savePage($input) {
        if (empty($input['url'])) {
            $input['url'] = $this->seoTools->createNiceUrl($input['title']);
        } else {
            $input['url'] = $this->seoTools->createNiceUrl($input['url']);
        }
        if (isset($input['id'])) {
            $page = $this->pageRepository->updatePage($input);
        } else {
            $page = $this->pageRepository->createPage($input);
        }
        return $this->pageRepository->getPageById($page['id']);
    }

    /**
     * Deletes blog post by given ID
     *
     * @param $id
     *
     * @return array
     */
    public function deleteBlogPost($id) {
        return $this->pageRepository->deletePage($id);
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function publishBlogPost($id) {
        return $this->pageRepository->publishPage($id);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function unpublishBlogPost($id) {
        return $this->pageRepository->unpublishPage($id);
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
