<?php

namespace App\Helpers;

use App\Models\User;

class Helper
{
    public function verifyAuthUser($userId)
    {
        $user = User::find($userId);

        $user ? $user=true : $user=false;

        return $user;
    }

    public function authenticUser($userId, $compareId){
        $verify = $this->verifyAuthUser($userId);

        if(!$verify) return false;

        if($compareId !== $userId) return false;

        return true;
    }
}