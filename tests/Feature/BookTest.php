<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookTest extends TestCase
{
    use DatabaseTransactions;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * A books test example.
     *
     * @return void
     */
    public function testBooksTest()
    {
        $count = Book::count();
        $response = $this->actingAs($this->user, 'api')->getJson('/api/books');
        $response->assertStatus(200)->assertJsonStructure([
            'data' => ['*' => ['id', 'name']],
        ])->assertJsonCount($count, 'data');
    }

    public function testBookTest()
    {
        $response = $this->actingAs($this->user, 'api')->getJson('/api/books/1');
        $response->assertStatus(200)->assertJsonStructure([
            'data' => ['id', 'name', 'authors' => ['*' => ['id', 'name']]],
        ]);
    }

    public function testBooksAuthorTest()
    {
        $authorId = 1;
        $count = Author::find($authorId)->books()->count();
        $response = $this->actingAs($this->user, 'api')->getJson("/api/books/author/$authorId");
        $response->assertStatus(200)->assertJsonStructure([
            'data' => ['*' => ['id', 'name']],
        ])->assertJsonCount($count, 'data');
    }

    public function testCreateBookTest()
    {
        $payload = [
            'name' => 'Book Test',
            'author_id' => 1
        ];

        $this->actingAs($this->user, 'api')->postJson('/api/books', $payload, [])
            ->assertStatus(201)->assertJsonStructure([
                'data' => ['id', 'name', 'authors' => ['*' => ['id', 'name']]],
            ])->assertJson([
                'data' => [ 'name' => $payload['name'] ],
            ]);
    }
}
