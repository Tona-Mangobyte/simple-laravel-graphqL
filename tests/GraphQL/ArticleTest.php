<?php

namespace Tests\GraphQL;

use Tests\TestCase;

class ArticleTest extends TestCase
{

    /** @test */
    public function testArticleById(): void {
        $response = $this->graphQL('{
            article(id: 1) {
                id,
                title,
                content
            }
        }');
        $article = $response['data']['article'];
        $this->assertEquals(1, $article['id']);
        $this->assertEquals("simple-new title", $article['title']);
    }

    /** @test */
    public function testArticles(): void {
        $response = $this->graphQL('{
            articles {
                id,
                title,
                content,
                author {
                 id,name,email
                }
            }
        }');
        $articles = $response['data']['articles'];
        $this->assertEquals(1, $articles[0]['id']);
        $this->assertEquals("simple-new title", $articles[0]['title']);

        $this->assertEquals(1, $articles[0]['author']['id']);
        $this->assertEquals("tona@mb", $articles[0]['author']['name']);
    }

    /** @test */
    public function testCreateArticle(): void {
        $response = $this->graphQL('
        mutation($title: String!, $content: String!, $userId: Int!) {
           createArticle(input:{title: $title, content: $content, userId: $userId}){
                 id
                 title,
                 content,
                 user_id
           }
        }',[
            'title' => "simple new title",
            'content' => "simple-new content",
            'userId' => 1
        ]);
        $article = $response['data']['createArticle'];
        $this->assertEquals("simple new title", $article['title']);
        $this->assertEquals("simple-new content", $article['content']);
        $this->assertEquals(1, $article['user_id']);
    }

}
