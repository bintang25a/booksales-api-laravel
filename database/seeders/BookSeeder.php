<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::create([
            'title' => 'The Art of Frozen',
            'description' => "Explore the magical kingdom of Arendelle with behind-the-scenes concept art from Disney's Frozen.",
            'price' => 25000,
            'stock' => 30,
            'cover_photo' => 'https://images.tokopedia.net/img/cache/500-square/VqbcmM/2022/8/21/99fa7fae-1a9d-43e7-a6d2-ec78cbfed3a2.jpg',
            'genre_id' => 2,
            'author_id' => 1
        ]);

        Book::create([
            'title' => 'The Art of Big Hero 6',
            'description' => "Go deep into the tech-savvy city of San Fransokyo and see the creation of Baymax and his team.",
            'price' => 30000,
            'stock' => 20,
            'cover_photo' => 'https://i.ebayimg.com/images/g/IP8AAOSwTeVhnWA3/s-l400.jpg',
            'genre_id' => 2,
            'author_id' => 2
        ]);

        Book::create([
            'title' => 'The Art of Inside Out',
            'description' => "Journey inside the mind with stunning artwork from the Pixar movie Inside Out.",
            'price' => 50000,
            'stock' => 20,
            'cover_photo' => 'https://m.media-amazon.com/images/I/91CA88oFlhL._AC_UF1000,1000_QL80_.jpg',
            'genre_id' => 2,
            'author_id' => 3
        ]);
    }
}
