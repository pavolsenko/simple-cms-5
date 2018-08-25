<?php namespace App\Blog\Page;

use App\Tools\SeoTools;

class PageService {

    private $pageRepository;
    private $seoTools;

    public function __construct(PageRepositoryInterface $pageRepositoryInterface, SeoTools $seoTools) {
        $this->pageRepository = $pageRepositoryInterface;
        $this->seoTools = $seoTools;
    }

    public function getPageById($id) {
        return $this->pageRepository->getPageById($id);
    }

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
}