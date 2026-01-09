<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{

    public function index()
    {
        return view('favourites');
    }

    public function toggle(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to use favourites'
            ], 401);
        }
        
        $request->validate([
            'pizza_id' => 'required|integer|exists:pizzas,pizza_id'
        ]);
        
        $user = Auth::user();
        $pizza = Pizza::findOrFail($request->pizza_id);
        
        if ($user->favourites()->where('pizza_id', $pizza->pizza_id)->exists()) {
            $user->favourites()->detach($pizza);
            $message = 'Removed from favourites';
            $isFavourite = false;
        } else {
            $user->favourites()->attach($pizza);
            $message = 'Added to favourites';
            $isFavourite = true;
        }
        
        return response()->json([
            'success' => true,
            'message' => $message,
            'is_favourite' => $isFavourite
        ]);
    }
    

    public function list(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to view favourites'
            ], 401);
        }
        
        $user = Auth::user();
        $favourites = $user->favourites()->with(['category', 'sizes'])->get();
        
        return response()->json([
            'success' => true,
            'favourites' => $favourites
        ]);
    }
}