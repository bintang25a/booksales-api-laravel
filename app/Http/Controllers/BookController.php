<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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

    public function show(string $id)
    {
        $book = Book::with('author', 'genre')->find($id);

        if($book) {
            return response()->json([
                'succes' => 'true',
                'message' => 'show book by id',
                'data' => $book
            ], 200);
        }
        else {
            return response()->json([
                'succes' => 'false',
                'message' => 'data not found'
            ], 404);
        }
    }

    public function update(string $id, Request $request)
    {
        $book = Book::find($id);

        if(!$book) {
            return response()->json([
            'succes' => 'false',
            'message' => 'data not found, try another id'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'cover_photo' => 'nullable|image|mimes:jpeg,jpg,png|max:4096',
            'genre_id' => 'required|exists:genres,id',
            'author_id' => 'required|exists:authors,id'
        ]);

        if($validator->fails()) {
            return response()->json([
                'succes' => 'failed',
                'message' => $validator->errors()
            ], 422);
        }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'genre_id' => $request->genre_id,
            'author_id' => $request->author_id,
        ];

        if($request->hasFile('cover_photo')) {
            $image = $request->file('cover_photo');
            $image->store('books', 'public');

            if($book->cover_photo) {
                Storage::disk('public')->delete('books/' . $book->cover_photo);
            }

            $data['cover_photo'] = $image->hashName();
        }

        $book->update($data);

        return response()->json([
            'succes' => 'true',
            'message' => 'resource updated succesfully',
            'data' => $book
        ], 200);
    }

    public function destroy(string $id)
    {
        $book = Book::find($id);

        if($book) {
            if($book->cover_photo) {
                Storage::disk('public')->delete('books/' . $book->cover_photo);
            }

            $book->delete();

            return response()->json([
                'succes' => 'true',
                'message' => 'delete book succes'
            ], 200);
        }
        else {
            return response()->json([
                'succes' => 'false',
                'message' => 'data not found, delete failed'
            ], 404);
        }
    }
}
