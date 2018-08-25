<?php namespace App\Blog\Page;

use App\Helpers\SeoHelper;

class PageService {

    private $pageRepository;
    private $seoHelper;

    public function __construct(PageRepositoryInterface $pageRepositoryInterface, SeoHelper $seoHelper) {
        $this->pageRepository = $pageRepositoryInterface;
        $this->seoHelper = $seoHelper;
    }

    public function getPageById($id) {
        return $this->pageRepository->getPageById($id);
    }

    public function savePage($input) {
        if (empty($input['url'])) {
            $input['url'] = $this->seoHelper->createNiceUrl($input['title']);
        } else {
            $input['url'] = $this->seoHelper->createNiceUrl($input['url']);
        }
        if (isset($input['id'])) {
            $page = $this->pageRepository->updatePage($input);
        } else {
            $page = $this->pageRepository->createPage($input);
        }
        return $this->pageRepository->getPageById($page['id']);
    }
}