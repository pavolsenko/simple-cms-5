<?php

namespace App\Blog\Author;


class EloquentAuthorRepository implements AuthorRepositoryInterface {

    private $author;

    public function __construct(Author $author) {
        $this->author = $author;
    }

    public function createAuthor($input) {

    }

    public function deleteAuthor($id) {

    }

    public function getAuthorById($id) {
        return $this->author
            ->where('id', $id)
            ->first()
            ->toArray();
    }

    public function getAllAuthors() {
        $authors = $this->author->get();
        if (!is_null($authors)) {
            $authors = $authors->toArray();
        }
        return $authors;
    }

}