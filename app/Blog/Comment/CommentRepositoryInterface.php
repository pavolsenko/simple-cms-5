<?php

namespace App\Blog\Comment;

interface CommentRepositoryInterface {
    public function createComment($input);
    public function deleteComment($id);
    public function getCommentsByBlogPostId($id);
    public function getAllComments();
    public function getWaitingComments();
    public function getApprovedComments();
}
