<?php

namespace App\Repositories\Contracts;

interface PostsRepositoryInterface
{
    public function findAllPosts();
    public function findPost($idPost);
    public function storePost(array $data);
    public function updatePost(array $data, $idPost);
    public function destroyPost($idPost);
}