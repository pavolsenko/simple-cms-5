<?php

namespace App\Blog\Author;

interface AuthorRepositoryInterface {
    public function createAuthor($input);
    public function deleteAuthor($id);
    public function getAuthorById($id);
    public function getAllAuthors();
}
