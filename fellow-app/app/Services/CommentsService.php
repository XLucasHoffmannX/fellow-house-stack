<?php

namespace App\Services;

use App\Repositories\CommentsRepository;

class CommentsService
{
    public function __construct(CommentsRepository $commentsRepository)
    {
        $this->commentsRepository = $commentsRepository;
    }

    public function findAllComments()
    {
        $comments = $this->commentsRepository->all();

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

    public function updateComment(array $data, $idComment)
    {
        $updatedComment = $this->commentsRepository->update($data, $idComment);

        return $updatedComment;
    }

    public function deletedPost($idComment)
    {
        $deletedPost = $this->commentsRepository->delete($idComment);

        return $deletedPost;
    }
}
