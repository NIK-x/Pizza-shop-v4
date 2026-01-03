<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function index()
    {
        return view('favourites');
    }
    
    public function toggle(Request $request)
    {
        $data = $request->validate([
            'pizza_id' => 'required|integer|exists:pizzas,pizza_id',
        ]);
        
        $userId = Auth::id();
        
        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }
        
        $favourite = Favourite::where('user_id', $userId)
            ->where('pizza_id', $data['pizza_id'])
            ->first();
        
        if ($favourite) {
            $favourite->delete();
            $added = false;
        } else {
            Favourite::create([
                'user_id' => $userId,
                'pizza_id' => $data['pizza_id']
            ]);
            $added = true;
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Favourite updated',
            'added' => $added
        ]);
    }
    
    public function list()
    {
        $userId = Auth::id();
        
        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }
        
        $favourites = Favourite::with('pizza')
            ->where('user_id', $userId)
            ->get()
            ->pluck('pizza');
        
        return response()->json([
            'success' => true,
            'favourites' => $favourites
        ]);
    }
}