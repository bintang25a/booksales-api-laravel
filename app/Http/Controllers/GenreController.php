<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

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
}
