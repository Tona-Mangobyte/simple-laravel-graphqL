<?php

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\Auth;

final class Me
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $guard = Auth::guard();

        /** @var \App\Models\User|null $user */
        $user = $guard->user();

        return $user;
    }
}
