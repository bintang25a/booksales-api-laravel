<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->get();

        return response()->json([
            "succes" => true,
            "message" => "Get All Resource",
            "data" => $books
        ], 200);
    }
}
