<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth()->guard('api')->user();
    }

    public function get(){
        $userAuth = $this->user;

        return compact('userAuth');
    }
}
