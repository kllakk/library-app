<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use App\Models\BookAuthor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Book::factory(10)->create()->each(function($book) {
            Author::factory(rand(1, 3))->create()->each(function($author) use($book) {
                BookAuthor::create([
                    'author_id' => $author->id,
                    'book_id' => $book->id,
                ]);
            });
        });
    }
}
