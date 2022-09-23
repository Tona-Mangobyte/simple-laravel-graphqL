<?php

namespace App\GraphQL\Queries;

final class Hello
{

    public function __invoke()
    {
        $data = [
            "hello" => "Hello World"
        ];
        return $data;
    }
}
