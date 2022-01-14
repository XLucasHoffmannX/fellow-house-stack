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

    public function findLike($idLike)
    {
        $like = $this->likesRepository->find($idLike);

        return $like;
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

    public function deleteLike($idLike){
        $deletedLike = $this-> likesRepository->delete($idLike);

        return $deletedLike;
    }
}
