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
        $this->assertEquals("tona@mb", $users[0]['name']);
        $this->assertEquals("tona@mb.com", $users[0]['email']);
    }

    /** @test */
    public function testUsersListConditions(): void {
        $response = $this->graphQL('{
            usersCond{
               id,
               name,
               email
            }
        }');
        $users = $response['data']['usersCond'];
        $this->assertEquals(1, $users[0]['id']);
        $this->assertEquals("tona@mb", $users[0]['name']);
        $this->assertEquals("tona@mb.com", $users[0]['email']);
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
        $this->assertEquals("tona@mb", $user['name']);
        $this->assertEquals("tona@mb.com", $user['email']);
    }

    /** @test */
    public function testCreateUser(): void {
        $email = Str::random(16).'@mb.com';
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
        $user = $response['data']['createUser'];
        $this->assertEquals("simple new account", $user['name']);
        $this->assertEquals($email, $user['email']);
    }

    /** @test */
    public function testCreateUser2(): void {
        $email = Str::random(16).'@mb.com';
        $this->graphQL('
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
        ])->assertJson([
            'data' => [
                'createUser' => [
                    'name' => 'simple new account',
                    'email' => $email
                ]
            ]
        ]);
    }
}
