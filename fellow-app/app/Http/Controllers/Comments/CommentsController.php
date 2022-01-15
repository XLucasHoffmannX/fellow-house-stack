<?php

namespace App\Http\Controllers\Comments;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Services\CommentsService;
use App\Services\PostsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    protected $commentsService;
    protected $helper;

    public function __construct(
        CommentsService $commentsService,
        Helper $helper,
        PostsService $postsService
    ) {
        $this->user = Auth()->guard('api')->user();
        $this->helper = $helper;
        $this->commentsService = $commentsService;
        $this->postsService = $postsService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = $this->commentsService->findAllComments();

        if (count($comments) === 0) return response()->json(['error' => 'Nenhum resultado!'], 400);

        return $comments;
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
        if (!$authVerify) return response()->json(["error" => "Erro encontrado! Usuário inexistente!"], 400);

        /* Aplicar contracts */
        $validator = Validator::make($data, [
            "post_id" => "required|string",
            "user_reference" => "required|string",
            "content" => "required|string",
        ]);

        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 400);

        $newComment = $this->commentsService->storeComment($data);

        return response()->json($newComment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commentAtPost = $this->commentsService->findCommentAtPost($id);

        if (count($commentAtPost) === 0) return response()->json(['error' => 'Post não possui comentários'], 400);

        return response()->json($commentAtPost);
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
        if (!$authVerify) return response()->json(["error" => "Erro encontrado! Usuário inexistente!"], 400);

        /* Post existe */
        $postExists = $this->postsService->findPost($data["post_id"]);
        if (!$postExists) return response()->json(["error" => "Erro encontrado! Post inexistente!"], 400);

        $commentAtPost = $this->commentsService->updateComment($data, $id);

        return response()->json($commentAtPost);
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
        if(!$authVerify) return response()->json(["error" => "Erro encontrado! Usário inexistente!"], 400);

        $deletedComment = $this->commentsService->deletedPost($id);

        return response()->json($deletedComment);
    }
}
