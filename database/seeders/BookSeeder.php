<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::insert([
            ['title' => 'Bumi', 'author_id' => 1],
            ['title' => 'Supernova', 'author_id' => 2],
            ['title' => 'Laskar Pelangi', 'author_id' => 3],
            ['title' => 'Ayat-Ayat Cinta', 'author_id' => 4],
            ['title' => 'Catatan Hati Seorang Istri', 'author_id' => 5],
        ]);
    }
}
