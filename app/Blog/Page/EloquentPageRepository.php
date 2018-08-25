<?php

namespace App\Blog\Page;

use Illuminate\Contracts\Auth\Guard as Auth;

class EloquentPageRepository implements PageRepositoryInterface {

    const ENABLED = 1;
    const DISABLED = 0;
    const PAGES_PER_PAGE_ADMIN = 20;

    protected $page;
    private $auth;

    public function __construct(Page $page, Auth $auth) {
        $this->page = $page;
        $this->auth = $auth;
    }

    public function getPageByUrl($url) {
        $page = $this->page
            ->where('url', $url)
            ->where('enabled', self::ENABLED)
            ->first();
        if (!is_null($page)) {
            $page = $page->toArray();
        }
        return $page;
    }

    public function getPageById($id) {
        $page = $this->page
            ->where('id', $id)
            ->first();
        if (!is_null($page)) {
            $page = $page->toArray();
        }
        return $page;
    }

    public function getAllPages() {
        $pages = $this->page
            ->orderBy('created_at', 'desc')
            ->paginate(self::PAGES_PER_PAGE_ADMIN);
        if (!is_null($pages)) {
            $pages = $pages->toArray();
        }
        return $pages;
    }

    public function createPage($input) {
        $this->page->title = $input['title'];
        $this->page->body_text = $input['body_text'];
        $this->page->created_by = $this->auth->user()->getAuthIdentifier();
        $this->page->updated_by = $this->auth->user()->getAuthIdentifier();
        $this->page->enabled = self::ENABLED;
        $this->page->url = $input['url'];
        $this->page->meta_title = $input['meta_title'];
        $this->page->meta_keywords = $input['meta_keywords'];
        $this->page->meta_description = $input['meta_description'];
        $this->page->save();
        return $this->page->toArray();
    }

    public function updatePage($input) {
        $this->page = $this->page
            ->where('id', $input['id'])
            ->first();
        if (!is_null($this->page)) {
            $this->page->title = $input['title'];
            $this->page->body_text = $input['body_text'];
            $this->page->updated_by = $this->auth->user()->getAuthIdentifier();
            $this->page->url = $input['url'];
            $this->page->meta_title = $input['meta_title'];
            $this->page->meta_keywords = $input['meta_keywords'];
            $this->page->meta_description = $input['meta_description'];
            $this->page->save();
        }
        return $this->page->toArray();
    }

    public function deletePage($id) {
        return $this->page->delete($id);
    }

    public function publishPage($id) {
        $page = $this->page
            ->where('id', $id)
            ->first();
        if (!is_null($page)) {
            $page->enabled = self::ENABLED;
            $page->save();
            return true;
        } else {
            return false;
        }
    }

    public function unpublishPage($id) {
        $page = $this->page
            ->where('id', $id)
            ->first();
        if (!is_null($page)) {
            $page->enabled = self::DISABLED;
            $page->save();
            return true;
        } else {
            return false;
        }
    }
}

