<?php

namespace App\GraphQL\Mutations;

use App\Models\Article;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class ArticleMutator
{
    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue
     * @param  mixed[]  $args
     * @param  GraphQLContext  $context
     * @return mixed
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context)
    {
        $article = new Article($args);
        $context->user()->articles()->save($article);

        return $article;
    }
}
