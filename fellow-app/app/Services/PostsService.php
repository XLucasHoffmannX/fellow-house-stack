<?php

namespace App\Services;

use App\Repositories\PostsRepository;

class PostsService
{
    public function __construct(PostsRepository $postsRepository)
    {
        $this->postsRepository = $postsRepository;
    }

    public function findAllPosts()
    {
        $posts = $this->postsRepository->all();

        return $posts;
    }

    public function findPost($idPost)
    {
        $post = $this->postsRepository->find($idPost);

        if(!$post) return false;

        return $post;
    }

    public function storePost(array $data)
    {
        $newPost = $this->postsRepository->create($data);

        return $newPost;
    }

    public function updatePost(array $data, $idPost)
    {   
        $updatePost = $this->postsRepository->update($data, $idPost);

        return $updatePost;
    }

    public function deletePost($idPost)
    {   
        $deletedPost = $this->postsRepository->delete($idPost);

        return $deletedPost;
    }
}
