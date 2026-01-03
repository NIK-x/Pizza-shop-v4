<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Pizza;
use App\Models\Size;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cartItems = CartItem::with(['pizza', 'size'])
            ->where(function($query) {
                if (Auth::check()) {
                    $query->where('user_id', Auth::id());
                } else {
                    $query->where('session_id', session()->getId());
                }
            })
            ->get();
        
        $total = $cartItems->sum('total_price');
        
        return response()->json([
            'success' => true,
            'cart' => $cartItems,
            'total' => $total
        ]);
    }
    
    public function add(Request $request)
    {
        $data = $request->validate([
            'pizza_id' => 'required|integer|exists:pizzas,pizza_id',
            'size_id' => 'required|integer|exists:sizes,id_sizes',
            'quantity' => 'required|integer|min:1|max:10',
            'extra_ingredients' => 'array',
            'extra_ingredients.*.id' => 'integer|exists:ingredients,id_ingredients',
            'extra_ingredients.*.quantity' => 'integer|min:1|max:5'
        ]);
        
        $pizza = Pizza::findOrFail($data['pizza_id']);
        $size = Size::findOrFail($data['size_id']);
        
        // Получаем цену размера из pivot таблицы
        $sizePrice = $pizza->sizes()->where('id_sizes', $size->id_sizes)->first()->pivot->price;
        
        // Расчет цены дополнительных ингредиентов
        $extraPrice = 0;
        $extraIngredientsData = [];
        
        if (!empty($data['extra_ingredients'])) {
            foreach ($data['extra_ingredients'] as $extra) {
                $ingredient = Ingredient::find($extra['id']);
                if ($ingredient) {
                    $extraPrice += $ingredient->ingredients_price * $extra['quantity'];
                    $extraIngredientsData[] = [
                        'id' => $ingredient->id_ingredients,
                        'name' => $ingredient->ingredients_name,
                        'price' => $ingredient->ingredients_price,
                        'quantity' => $extra['quantity']
                    ];
                }
            }
        }
        
        $totalPrice = ($sizePrice + $extraPrice) * $data['quantity'];
        
        $cartItem = CartItem::updateOrCreate(
            [
                'pizza_id' => $data['pizza_id'],
                'size_id' => $data['size_id'],
                'user_id' => Auth::check() ? Auth::id() : null,
                'session_id' => Auth::check() ? null : session()->getId(),
                'extra_ingredients' => json_encode($extraIngredientsData)
            ],
            [
                'quantity' => $data['quantity'],
                'total_price' => $totalPrice
            ]
        );
        
        return response()->json([
            'success' => true,
            'message' => 'Added to cart',
            'cart_item' => $cartItem->load(['pizza', 'size'])
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:1|max:10'
        ]);
        
        $cartItem = CartItem::where('id', $id)
            ->where(function($query) {
                if (Auth::check()) {
                    $query->where('user_id', Auth::id());
                } else {
                    $query->where('session_id', session()->getId());
                }
            })
            ->firstOrFail();
        
        // Пересчет цены
        $pizza = $cartItem->pizza;
        $size = $cartItem->size;
        $sizePrice = $pizza->sizes()->where('id_sizes', $size->id_sizes)->first()->pivot->price;
        
        $extraPrice = 0;
        $extraIngredients = json_decode($cartItem->extra_ingredients, true) ?? [];
        foreach ($extraIngredients as $extra) {
            $extraPrice += $extra['price'] * $extra['quantity'];
        }
        
        $cartItem->quantity = $data['quantity'];
        $cartItem->total_price = ($sizePrice + $extraPrice) * $data['quantity'];
        $cartItem->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Cart updated',
            'cart_item' => $cartItem
        ]);
    }
    
    public function remove($id)
    {
        $cartItem = CartItem::where('id', $id)
            ->where(function($query) {
                if (Auth::check()) {
                    $query->where('user_id', Auth::id());
                } else {
                    $query->where('session_id', session()->getId());
                }
            })
            ->firstOrFail();
        
        $cartItem->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Removed from cart'
        ]);
    }
    
    public function clear()
    {
        CartItem::where(function($query) {
            if (Auth::check()) {
                $query->where('user_id', Auth::id());
            } else {
                $query->where('session_id', session()->getId());
            }
        })->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Cart cleared'
        ]);
    }
}