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
        $user = new User;
        $user['name'] = $userReq['name'];
        $user['email'] = $userReq['email'];
        $user['password'] = bcrypt($userReq['password']);
        $user->save();
        return $user;
    }
}
