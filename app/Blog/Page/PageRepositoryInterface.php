<?php

namespace App\Blog\Page;

interface PageRepositoryInterface {
    public function getPageByUrl($url);
    public function getPageById($id);
    public function getAllPages();
    public function createPage($input);
    public function updatePage($input);
    public function deletePage($id);
    public function publishPage($id);
    public function unpublishPage($id);

}
