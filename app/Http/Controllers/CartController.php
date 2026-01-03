<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $data = $request->validate([
            'pizza_id' => 'required|integer',
            'size_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Added to cart',
            'data' => $data
        ]);
    }
    
    public function index()
    {
        return response()->json([
            'success' => true,
            'cart' => []
        ]);
    }
    
    public function remove($id)
    {
        return response()->json([
            'success' => true,
            'message' => 'Removed from cart'
        ]);
    }
}