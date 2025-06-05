<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Pest\Laravel\Json;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::all();

        return response()->json([
            "succes" => true,
            "message" => "Get All Resource",
            "data" => $genres
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'succes' => 'failed',
                'message' => $validator->errors()
            ], 422);
        }

        $genres = Genre::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'succes' => 'true',
            'message' => 'resource added succesfully',
            'data' => $genres
        ], 201);
    }

    public function show(string $id)
    {
        $genre = Genre::find($id);

        if ($genre) {
            return response()->json([
                'succes' => 'true',
                'message' => 'show genre by id',
                'data' => $genre
            ], 200);
        } else {
            return response()->json([
                'succes' => 'false',
                'message' => 'data not found'
            ], 404);
        }
    }

    public function update(string $id, Request $request)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'succes' => 'false',
                'message' => 'data not found, try another id'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'succes' => 'failed',
                'message' => $validator->errors()
            ], 422);
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description
        ];

        $genre->update($data);

        return response()->json([
            'succes' => 'true',
            'message' => 'resource updated succesfully',
            'data' => $genre
        ], 200);
    }

    public function destroy(string $id)
    {
        $genre = Genre::find($id);

        if ($genre) {
            $genre->delete();

            return response()->json([
                'succes' => 'true',
                'data' => $genre,
                'message' => 'delete genre succes'
            ], 200);
        } else {
            return response()->json([
                'succes' => 'false',
                'message' => 'data not found, delete failed'
            ], 404);
        }
    }
}
