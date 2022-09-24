<?php

namespace Tests\GraphQL;

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
}
