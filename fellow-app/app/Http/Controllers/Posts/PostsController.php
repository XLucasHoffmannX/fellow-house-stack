<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Services\PostsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;
class PostsController extends Controller
{
    protected $postsService;
    protected $helper;

    public function __construct(PostsService $postsService, Helper $helper)
    {
        $this->user = Auth()->guard('api')->user();
        $this->helper = $helper;
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

        $user = $this->user;

        $authVerify = $this->helper->verifyAuthUser($user->id);
        if(!$authVerify) return response()->json(["msg" => "Erro encontrado! Usário inexistente!"]);

        $authentic = $this->helper->authenticUser($user->id, $data['user_id']);
        if(!$authentic) return response()->json(["msg" => "Você não é autor do post!"]);

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
        $user = $this->user;
        $data = $request->all();

        $authVerify = $this->helper->verifyAuthUser($user->id);
        if(!$authVerify) return response()->json(["msg" => "Erro encontrado! Usário inexistente!"]);

        $authentic = $this->helper->authenticUser($user->id, $data['user_id']);
        if(!$authentic) return response()->json(["msg" => "Você não é autor do post!"]);

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
        $user = $this->user;

        $authVerify = $this->helper->verifyAuthUser($user->id);
        if(!$authVerify) return response()->json(["msg" => "Erro encontrado! Usário inexistente!"]);
        
        /* não esquecer de verificar autenticidade */

        $deletedPost = $this->postsService->deletePost($id);

        return response()->json($deletedPost);
    }
}
