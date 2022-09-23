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
        $this->assertEquals("Sint qui officiis veritatis.", $article['title']);
    }

    /** @test */
    public function testArticleCreate(): void {
        $response = $this->graphQL('{
        mutation(title: String!, content: String!, user_id: Int) {
          createArticle(title: $title, content: $content, user_id: $user_id) {
            id,
            title,
            content
          }
        }',
        [
            'title' => 'simple title',
            'content' => 'simple content',
            'user_id' => 1
        ]);
        print_r($response);
        // $article = $response['data']['article'];
        // $this->assertEquals(1, $article['id']);
        // $this->assertEquals("simple title", $article['title']);
    }

}
