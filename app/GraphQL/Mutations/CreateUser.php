<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Facades\Log;

final class CreateUser
{
    /**
     * @param  null  $_
     * @param  array{}  $userReq
     */
    public function __invoke($_, array $userReq)
    {
        Log::debug('user created');
        Log::info(json_encode($userReq));
        $user = new User;
        $user['name'] = $userReq['input']['name'];
        $user['email'] = $userReq['input']['email'];
        $user['password'] = bcrypt($userReq['input']['password']);
        $user->save();
        return $user;
    }
}
