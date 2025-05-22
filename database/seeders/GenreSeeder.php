<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run()
    {
        $genres = [
            'Science Fiction',
            'Fantasy',
            'Mystery',
            'Historical',
            'Horror'
        ];

        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }
    }
}
