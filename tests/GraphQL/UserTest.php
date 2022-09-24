<?php

namespace Tests\GraphQL;

use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function testUsersList(): void {
        $response = $this->graphQL('{
            users{
               id,
               name,
               email
            }
        }');
        $users = $response['data']['users'];
        $this->assertEquals(1, $users[0]['id']);
        $this->assertEquals("Tre Green DDS", $users[0]['name']);
        $this->assertEquals("graphql@test.com", $users[0]['email']);
    }

    /** @test */
    public function testUserById(): void {
        $response = $this->graphQL('{
           userById(id: 1) {
             id,
             name,
             email
           }
        }');
        $user = $response['data']['userById'];
        $this->assertEquals(1, $user['id']);
        $this->assertEquals("Tre Green DDS", $user['name']);
        $this->assertEquals("graphql@test.com", $user['email']);
    }

    /** @test */
    public function testCreateUser(): void {
        $email = Str::random(16);
        $response = $this->graphQL('
        mutation($name: String!, $email: String!, $password: String!) {
           createUser(input:{name: $name, email: $email, password: $password}){
                 id
                 name,
                 email
           }
        }',[
            'name' => 'simple new account',
            'email' => $email,
            'password' => '12345'
        ]);
        $article = $response['data']['createUser'];
        $this->assertEquals("simple new account", $article['name']);
        $this->assertEquals($email, $article['email']);
    }
}
