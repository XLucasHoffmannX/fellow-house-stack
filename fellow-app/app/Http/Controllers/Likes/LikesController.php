<?php

namespace App\Http\Controllers\Likes;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Services\LikesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LikesController extends Controller
{
    protected $likesService;
    protected $helper;

    public function __construct(LikesService $likesService, Helper $helper)
    {
        $this->user = Auth()->guard('api')->user();
        $this->likesService = $likesService;
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

        $authVerify = $this->helper->verifyAuthUser($user->id);
        if(!$authVerify) return response()->json(["msg" => "Erro encontrado! Usário inexistente!"]);

        /* Aplicar contracts */
        $validator = Validator::make($data, [
            "post_id" => "required|string",
            "user_reference" => "required|string",
            "type" => "numeric|max:4"
        ]);

        if($validator->fails()) return response()->json([ 'errors' => $validator->errors() ], 400);
        
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
