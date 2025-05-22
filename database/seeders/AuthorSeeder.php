<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        $authors = [
            'J.K. Rowling',
            'Stephen King',
            'Agatha Christie',
            'George Orwell',
            'Jane Austen'
        ];

        foreach ($authors as $author) {
            Author::create(['name' => $author]);
        }
    }
}
