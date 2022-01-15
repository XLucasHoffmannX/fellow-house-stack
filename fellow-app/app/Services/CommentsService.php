<?php

namespace App\Services;

use App\Http\Controllers\Comments\CommentsController;

class CommentsService
{
    public function __construct(CommentsController $commentsRepository)
    {
        $this->commentsRepository = $commentsRepository;
    }

    public function findAllComments()
    {
        $comments = $this->commentsRepository->find();

        return $comments;
    }

    public function findCommentAtPost($idPost)
    {
        $postComment = $this->commentsRepository->where("post_id", $idPost)->where("explict", 0)->get();

        return $postComment;
    }

    public function storeComment(array $data)
    {   
        $newComment = $this->commentsRepository->create($data);

        return $newComment;
    }
}
