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

        $authors = Author::create([
            'name' => $request->name
        ]);

        return response()->json([
            'succes' => 'true',
            'message' => 'resource added succesfully',
            'data' => $authors
        ], 201);
    }
}
