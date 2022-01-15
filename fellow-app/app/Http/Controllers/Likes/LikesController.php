<?php

namespace App\Http\Controllers\Likes;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Services\LikesService;
use App\Services\PostsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LikesController extends Controller
{
    protected $likesService;
    protected $helper;

    public function __construct(
        LikesService $likesService,
        Helper $helper,
        PostsService $postsService
    ) {
        $this->user = Auth()->guard('api')->user();
        $this->likesService = $likesService;
        $this->postsService = $postsService;
        $this->helper = $helper;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $likes = $this->likesService->findAllLikes();

        if (count($likes) === 0) return response()->json(['error' => 'Sem resultados de likes!']);

        return response()->json($likes);
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

        /* Post existe */
        $postExists = $this->postsService->findPost($data["post_id"]);

        if (!$postExists) return response()->json(["error" => "Erro encontrado! Post inexistente!"], 400);

        $authVerify = $this->helper->verifyAuthUser($user->id);
        if (!$authVerify) return response()->json(["error" => "Erro encontrado! Usuário inexistente!"], 400);

        $authVerify = $this->helper->verifyAuthUser($data['user_reference']);
        if (!$authVerify) return response()->json(["error" => "Erro encontrado! Usuário inexistente!"], 400);

        /* Aplicar contracts */
        $validator = Validator::make($data, [
            "post_id" => "required|string",
            "user_reference" => "required|string",
            "type" => "numeric|max:4"
        ]);

        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 400);

        /* Like Exists */
        $like_exists = $this->likesService->likesExistsInPost($data);

        if (!$like_exists) return response()->json(['error' => 'Ação de like excedido'], 400);

        $newLike = $this->likesService->storeLike($data);

        return response()->json($newLike);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->likesService->findLikeAtPost($id);

        if (count($post) === 0) return response()->json(['error' => 'Post não possui like'], 400);

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

        $user = $this->user;

        $authVerify = $this->helper->verifyAuthUser($user->id);
        if(!$authVerify) return response()->json(["error" => "Erro encontrado! Usuário inexistente!"], 400);

        /* Post existe */
        $postExists = $this->postsService->findPost($data["post_id"]);
        if (!$postExists) return response()->json(["error" => "Erro encontrado! Post inexistente!"], 400);

        $removeLike = $this->likesService->updateLike($data, $id);

        return response()->json($removeLike);
    }
}
