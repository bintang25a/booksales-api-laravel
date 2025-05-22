<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        $authors = [
            'Charles Solomon',
            'Jessica Julius',
            'Pete Docter',
            'Jeff Kurtti',
            'Kaliko Hurley'
        ];

        foreach ($authors as $author) {
            Author::create(['name' => $author]);
        }
    }
}
