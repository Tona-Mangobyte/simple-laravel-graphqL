<?php

namespace Tests\GraphQL;

use Tests\TestCase;

class LoginTest extends TestCase
{
    /** @test */
    public function testAuth(): void {
        $response = $this->graphQL('
         mutation{
            login(email:"tona@mb.com", password: "secret"){
              id,
              name,
              email
            }
         }
        ');
        $auth = $response['data']['login'];
        $this->assertEquals(1, $auth['id']);
        $this->assertEquals("tona@mb", $auth['name']);
        $this->assertEquals("tona@mb.com", $auth['email']);

        $headers = $response->baseResponse->headers;
        $this->assertFalse(is_null($headers->all("Set-Cookie")));
    }
}
