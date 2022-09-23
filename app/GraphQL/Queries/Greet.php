<?php

namespace App\GraphQL\Queries;

final class Greet
{
    /**
     * @param  null  $rootValue
     * @param  array{}  $args
     */
    public function __invoke($rootValue, array $args)
    {
        return [ "hello" => "Hello, {$args['name']}!"];
    }
}
