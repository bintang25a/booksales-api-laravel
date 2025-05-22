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

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if($validator->fails()) {
            return response()->json([
                'succes' => 'failed',
                'message' => $validator->errors()
            ], 422);
        }

        $genres = Genre::create([
            'name' => $request->name
        ]);

        return response()->json([
            'succes' => 'true',
            'message' => 'resource added succesfully',
            'data' => $genres
        ], 201);
    }
}
