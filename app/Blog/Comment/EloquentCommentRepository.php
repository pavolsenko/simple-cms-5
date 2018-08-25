<?php

namespace App\Blog\Comment;

use Illuminate\Http\Request;

class EloquentCommentRepository implements CommentRepositoryInterface {

    const APPROVED = 1;
    const WAITING = 0;

    private $comment;
    private $commentAuthor;
    private $request;

    public function __construct(Comment $comment, CommentAuthor $commentAuthor, Request $request) {
        $this->comment = $comment;
        $this->commentAuthor = $commentAuthor;
        $this->request = $request;
    }

    public function createComment($input) {
        if ($this->spam_check($input)) {
            $status = self::WAITING;
        } else {
            $status = self::APPROVED;
        }
        // check if author already posted a comment
        $check_comment_author = $this->commentAuthor->where('email', $input['email'])->first();
        if (is_null($check_comment_author)) {
            $this->commentAuthor->name = $input['name'];
            $this->commentAuthor->email = $input['email'];
            $this->commentAuthor->website = $input['website'];
            $this->commentAuthor->ip_address = $this->request->getClientIp();
            $this->commentAuthor->save();
        } else {
            $this->commentAuthor = $check_comment_author;
            $this->commentAuthor->name = $input['name'];
            $this->commentAuthor->website = $input['website'];
            $this->commentAuthor->ip_address = $this->request->getClientIp();
            $this->commentAuthor->save();
        }
        $this->comment->comment_author_id = $this->commentAuthor->id;
        $this->comment->blog_post_id = $input['blog_post_id'];
        $this->comment->text = $input['text'];
        $this->comment->status = $status;
        $this->comment->ip_address = $this->request->getClientIp();
        $this->comment->save();
        return $status;
    }

    public function deleteComment($id)
    {
        $this->comment = $this->comment
            ->where('id', $id)
            ->first();
        if (!is_null($this->comment)) {
            return $this->comment->delete();
        }
        return $this->comment;
    }

    public function getCommentsByBlogPostId($id) {
        return $this->comment->where('blog_post_id', $id)->toArray();
    }

    public function getAllComments() {
        return $this->comment->all()->toArray();
    }

    public function getWaitingComments(){
        return $this->comment->where('status', self::WAITING)->toArray();
    }

    public function getApprovedComments(){
        return $this->comment->where('status', self::APPROVED)->toArray();
    }

    private function spam_check($input) {
        // TODO: expand for real spam check and move out of repository
        if (!empty($input['website'])) {
            return true;
        } else {
            return false;
        }
    }

}