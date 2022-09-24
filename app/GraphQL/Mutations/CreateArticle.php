<?php

namespace App\GraphQL\Mutations;

use App\Models\Article;
use Illuminate\Support\Facades\Log;

final class CreateArticle
{
    /**
     * @param  null  $_
     * @param  array{}  $reqArticle
     */
    public function __invoke($_, array $reqArticle)
    {
        Log::debug('article created');
        $article = new Article;
        $article['title'] = $reqArticle['input']['title'];
        $article['content'] = $reqArticle['input']['content'];
        $article['user_id'] = $reqArticle['input']['userId'];
        $article->save();
        return $article;
    }
}
