<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {     
        $authors = Author::all();
         
        return response()->json([
            "succes" => true,
            "message" => "Get All Resource",
            "data" => $authors
        ], 200);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if($validator->fails()) {
            return response()->json([
                'succes' => 'failed',
                'message' => $validator->errors()
            ], 422);
        }

        $authors = Author::create([
            'name' => $request->name
        ]);

        return response()->json([
            'succes' => 'true',
            'message' => 'resource added succesfully',
            'data' => $authors
        ], 201);
    }

    public function show(string $id)
    {
        $author = Author::find($id);

        if($author) {
            return response()->json([
                'succes' => 'true',
                'message' => 'show author by id',
                'data' => $author
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
        $author = Author::find($id);

        if(!$author) {
            return response()->json([
            'succes' => 'false',
            'message' => 'data not found, try another id'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if($validator->fails()) {
            return response()->json([
                'succes' => 'failed',
                'message' => $validator->errors()
            ], 422);
        }

        $data = [
            'name' => $request->name
        ];

        $author->update($data);

        return response()->json([
            'succes' => 'true',
            'message' => 'resource updated succesfully',
            'data' => $author
        ], 200);
    }

    public function destroy(string $id)
    {
        $author = Author::find($id);

        if($author) {
            $author->delete();

            return response()->json([
                'succes' => 'true',
                'data' => $author,
                'message' => 'delete author succes'
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
