<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author', 'genre')->get();

        return response()->json([
            "succes" => true,
            "message" => "Get All Resource",
            "data" => $books
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'cover_photo' => 'image|mimes:jpeg,jpg,png|max:4096',
            'genre_id' => 'required|exists:genres,id',
            'author_id' => 'required|exists:authors,id'
        ]);

        if($validator->fails()) {
            return response()->json([
                'succes' => 'failed',
                'message' => $validator->errors()
            ], 422);
        }

        $image = $request->file('cover_photo');
        $image->store('books', 'public');

        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'cover_photo' => $image->hashName(),
            'genre_id' => $request->genre_id,
            'author_id' => $request->author_id,
        ]);

        return response()->json([
            'succes' => 'true',
            'message' => 'resource added succesfully',
            'data' => $book
        ], 201);
    }
}
