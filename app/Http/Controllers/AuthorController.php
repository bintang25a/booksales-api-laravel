<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

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
}
