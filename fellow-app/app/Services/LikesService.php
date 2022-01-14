<?php

namespace App\Services;

use App\Repositories\LikesRepository;

class LikesService
{
    public function __construct(LikesRepository $likesRepository)
    {
        $this->likesRepository = $likesRepository;
    }

    public function findAllLikes()
    {
        $likes = $this->likesRepository->all();

        return $likes;
    }

    public function findLikeAtPost($postId)
    {
        $post = $this->likesRepository->where("post_id", $postId)->where("ativ", 1)->get();

        return $post;
    }

    public function likesExistsInPost($dataPost)
    {
        $user_id = $dataPost["user_reference"];
        $post_id = $dataPost["post_id"];

        $like_exists = $this->likesRepository->where("user_reference", $user_id)->get();
        $like_exists_in_post = $this->likesRepository->where("post_id", $post_id)->get();

        if (count($like_exists) >= 1 && count($like_exists_in_post) >= 1) return false;
        
        return true;
    }

    public function storeLike(array $data)
    {
        $newLike = $this->likesRepository->create($data);

        return $newLike;
    }

    public function updateLike(array $data, $idLike)
    {
        $updateLike = $this->likesRepository->update($data, $idLike);

        return $updateLike;
    }
}
