<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');
        
        $query = Pizza::with(['category', 'sizes']);
        
        if ($filter !== 'all') {
            $query->whereHas('category', function($q) use ($filter) {
                $q->where('category_slug', $filter);
            });
        }
        
        $pizzas = $query->get();
        
        $regularPizzas = $pizzas->where('pizza_popular', false);
        $popularPizzas = $pizzas->where('pizza_popular', true);
        
        $categories = Category::all();
        $ingredients = Ingredient::all();
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'regularPizzas' => $regularPizzas,
                'popularPizzas' => $popularPizzas,
                'categories' => $categories,
                'filter' => $filter
            ]);
        }
        
        return view('main', compact('regularPizzas', 'popularPizzas', 'categories', 'ingredients', 'filter'));
    }
    
    public function getIngredients()
    {
        $ingredients = Ingredient::all();
        
        return response()->json([
            'success' => true,
            'ingredients' => $ingredients
        ]);
    }
}