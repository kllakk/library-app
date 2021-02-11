<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use Tests\TestCase;

class BookTest extends TestCase
{
    /**
     * A books test example.
     *
     * @return void
     */
    public function testBooksTest()
    {
        $count = Book::count();
        $response = $this->getJson('/api/books');
        $response->assertStatus(200)->assertJsonStructure([
            'data' => ['*' => ['id', 'name']],
        ])->assertJsonCount($count, 'data');
    }

    public function testBookTest()
    {
        $response = $this->getJson('/api/books/1');
        $response->assertStatus(200)->assertJsonStructure([
            'data' => ['id', 'name', 'authors' => ['*' => ['id', 'name']]],
        ]);
    }

    public function testBooksAuthorTest()
    {
        $authorId = 1;
        $count = Author::find($authorId)->books()->count();
        $response = $this->getJson("/api/books/author/$authorId");
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

        $this->json('POST', '/api/books', $payload, [])
            ->assertStatus(201)->assertJsonStructure([
                'data' => ['id', 'name', 'authors' => ['*' => ['id', 'name']]],
            ])->assertJson([
                'data' => [ 'name' => $payload['name'] ],
            ]);
    }
}
