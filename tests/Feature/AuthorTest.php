<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthorTest extends TestCase
{
    use DatabaseTransactions;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

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

        $this->actingAs($this->user, 'api')->postJson('/api/authors', $payload, [])
            ->assertStatus(201)->assertJsonStructure([
                'data' => ['id', 'name'],
            ])->assertJson([
                'data' => [ 'name' => $payload['name'] ],
            ]);
    }
}
