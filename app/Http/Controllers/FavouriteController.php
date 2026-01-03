<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function index()
    {
        return view('favourites');
    }
    
    public function toggle(Request $request)
    {
        $data = $request->validate([
            'pizza_id' => 'required|integer',
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Favourite updated'
        ]);
    }
}