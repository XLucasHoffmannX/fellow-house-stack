<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Services\PostsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function __construct(PostsService $postsService)
    {
        $this->postsService = $postsService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postsService->findAllPosts();

        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        /* Aplicar contracts */
        $validator = Validator::make($data, [
            "type" => "numeric|min:0|max:3",
            "content" => "required|string",
            "user_id" => "required|numeric"
        ]);

        if($validator->fails()) return response()->json([ 'errors' => $validator->errors() ], 400);

        $newPost = $this->postsService->storePost($data);

        return response()->json($newPost);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->postsService->findPost($id);

        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $postUpdate = $this->postsService->updatePost($data, $id);

        return response()->json($postUpdate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedPost = $this->postsService->deletePost($id);

        return response()->json($deletedPost);
    }
}
