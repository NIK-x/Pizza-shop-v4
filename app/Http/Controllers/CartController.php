<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Pizza;
use App\Models\Size;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Показать страницу корзины
     */
    public function index()
    {
        return view('favourites'); // Используем тот же шаблон, что и для favourites
    }
    
    /**
     * API: Получить содержимое корзины
     */
    public function getCart(Request $request)
    {
        $sessionId = $this->getSessionId($request);
        $userId = Auth::id();
        
        $cartItems = Cart::where(function($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->with(['pizza', 'size'])->get();
        
        return response()->json([
            'success' => true,
            'cart' => $cartItems,
            'total' => $cartItems->sum('total_price'),
            'count' => $cartItems->sum('quantity')
        ]);
    }
    
    /**
     * API: Добавить товар в корзину
     */
    public function add(Request $request)
    {
        $request->validate([
            'pizza_id' => 'required|integer|exists:pizzas,pizza_id',
            'size_id' => 'required|integer|exists:sizes,id_sizes',
            'quantity' => 'required|integer|min:1',
            'extra_ingredients' => 'array'
        ]);
        
        try {
            $pizza = Pizza::findOrFail($request->pizza_id);
            $size = Size::findOrFail($request->size_id);
            
            // Получаем цену размера из pivot таблицы
            $pizzaSize = $pizza->sizes()->where('sizes.id_sizes', $size->id_sizes)->first();
            
            if (!$pizzaSize) {
                return response()->json([
                    'success' => false,
                    'message' => 'This size is not available for this pizza'
                ], 400);
            }
            
            $sizePrice = $pizzaSize->pivot->price;
            
            // Рассчитываем стоимость дополнительных ингредиентов
            $ingredientsTotal = 0;
            $extraIngredients = [];
            
            if ($request->has('extra_ingredients') && is_array($request->extra_ingredients)) {
                foreach ($request->extra_ingredients as $ingredient) {
                    $ing = Ingredient::find($ingredient['id']);
                    if ($ing) {
                        $quantity = $ingredient['quantity'] ?? 1;
                        $ingredientsTotal += $ing->ingredients_price * $quantity;
                        $extraIngredients[] = [
                            'id' => $ing->id_ingredients,
                            'name' => $ing->ingredients_name,
                            'price' => $ing->ingredients_price,
                            'quantity' => $quantity
                        ];
                    }
                }
            }
            
            $totalPrice = ($sizePrice + $ingredientsTotal) * $request->quantity;
            
            // Проверяем, есть ли уже такой товар в корзине
            $existingCartItem = Cart::where('session_id', $this->getSessionId($request))
                ->where('pizza_id', $pizza->pizza_id)
                ->where('size_id', $size->id_sizes)
                ->where('extra_ingredients', json_encode($extraIngredients))
                ->first();
            
            if ($existingCartItem) {
                // Обновляем существующий товар
                $existingCartItem->quantity += $request->quantity;
                $existingCartItem->total_price += $totalPrice;
                $existingCartItem->save();
                
                $cartItem = $existingCartItem;
            } else {
                // Создаем новый товар в корзине
                $cartItem = Cart::create([
                    'user_id' => Auth::id(),
                    'session_id' => $this->getSessionId($request),
                    'pizza_id' => $pizza->pizza_id,
                    'size_id' => $size->id_sizes,
                    'quantity' => $request->quantity,
                    'extra_ingredients' => $extraIngredients,
                    'total_price' => $totalPrice
                ]);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Item added to cart',
                'cart_item' => $cartItem->load(['pizza', 'size']),
                'cart_count' => Cart::where('session_id', $this->getSessionId($request))->sum('quantity')
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding to cart: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * API: Обновить количество товара
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        
        try {
            $cartItem = Cart::findOrFail($id);
            
            // Проверяем, что пользователь имеет доступ к этой корзине
            if (!$this->checkCartAccess($cartItem, $request)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Access denied'
                ], 403);
            }
            
            // Пересчитываем стоимость
            $pizza = $cartItem->pizza;
            $sizePrice = $pizza->sizes()->where('sizes.id_sizes', $cartItem->size_id)->first()->pivot->price;
            
            $ingredientsTotal = 0;
            if ($cartItem->extra_ingredients) {
                foreach ($cartItem->extra_ingredients as $ingredient) {
                    $ingredientsTotal += $ingredient['price'] * $ingredient['quantity'];
                }
            }
            
            $cartItem->update([
                'quantity' => $request->quantity,
                'total_price' => ($sizePrice + $ingredientsTotal) * $request->quantity
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Cart updated',
                'cart_item' => $cartItem,
                'total_price' => $cartItem->total_price
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating cart: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * API: Удалить товар из корзины
     */
    public function remove($id, Request $request)
    {
        try {
            $cartItem = Cart::findOrFail($id);
            
            // Проверяем, что пользователь имеет доступ к этой корзине
            if (!$this->checkCartAccess($cartItem, $request)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Access denied'
                ], 403);
            }
            
            $cartItem->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error removing item: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * API: Очистить корзину
     */
    public function clear(Request $request)
    {
        try {
            $sessionId = $this->getSessionId($request);
            $userId = Auth::id();
            
            Cart::where(function($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Cart cleared'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error clearing cart: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Проверка доступа к элементу корзины
     */
    private function checkCartAccess($cartItem, $request)
    {
        $sessionId = $this->getSessionId($request);
        $userId = Auth::id();
        
        if ($userId) {
            return $cartItem->user_id == $userId;
        } else {
            return $cartItem->session_id == $sessionId;
        }
    }
    
    /**
     * Получить ID сессии для корзины
     */
    private function getSessionId($request)
    {
        if (!Session::has('cart_session_id')) {
            Session::put('cart_session_id', session()->getId());
        }
        return Session::get('cart_session_id');
    }
}