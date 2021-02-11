<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthorTest extends TestCase
{
    /**
     * A author test example.
     *
     * @return void
     */
    public function testCreateAuthorTest()
    {
        $payload = [
            'name' => 'Author Test',
        ];

        $this->json('POST', '/api/authors', $payload, [])
            ->assertStatus(201)->assertJsonStructure([
                'data' => ['id', 'name'],
            ])->assertJson([
                'data' => [ 'name' => $payload['name'] ],
            ]);
    }
}
