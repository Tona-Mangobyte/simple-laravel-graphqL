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

}
