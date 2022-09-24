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
        $this->assertEquals("Sint qui officiis veritatis.", $articles[0]['title']);

        $this->assertEquals(1, $articles[0]['author']['id']);
        $this->assertEquals("Tre Green DDS", $articles[0]['author']['name']);
    }

}
