<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PizzaSeeder extends Seeder
{
    public function run()
    {
        // Проверяем, есть ли уже пиццы
        if (DB::table('pizzas')->count() == 0) {
            $this->createPizzas();
        }
    }
    
    private function createPizzas()
    {
        // Получаем ID категорий
        $meatCat = DB::table('categories')->where('category_slug', 'meat')->first();
        $vegCat = DB::table('categories')->where('category_slug', 'vegetarian')->first();
        $seaCat = DB::table('categories')->where('category_slug', 'sea')->first();
        $mushCat = DB::table('categories')->where('category_slug', 'mushroom')->first();
        
        // Пиццы
        $pizzas = [
            // Обычные пиццы
            [
                'pizza_name' => 'Italian',
                'pizza_description' => 'Filling: pepperoni, salami, mozzarella, tomato sauce, Italian herbs',
                'pizza_popular' => 0,
                'category_id' => $meatCat->category_id,
                'pizza_price' => 8.35,
                'pizza_image' => 'images/italian-pizza.png'
            ],
            [
                'pizza_name' => 'Venecia',
                'pizza_description' => 'Filling: shrimp, mussels, calamari, gorgonzola cheese, pesto sauce',
                'pizza_popular' => 0,
                'category_id' => $seaCat->category_id,
                'pizza_price' => 7.35,
                'pizza_image' => 'images/venecia-pizza.png'
            ],
            [
                'pizza_name' => 'Meat',
                'pizza_description' => 'Filling: bacon, ham, pepperoni, chicken, cheddar cheese, BBQ sauce',
                'pizza_popular' => 0,
                'category_id' => $meatCat->category_id,
                'pizza_price' => 9.35,
                'pizza_image' => 'images/meat-pizza.png'
            ],
            [
                'pizza_name' => 'Cheese',
                'pizza_description' => 'Filling: 4-cheese blend: mozzarella, parmesan, gorgonzola, cheddar',
                'pizza_popular' => 0,
                'category_id' => $vegCat->category_id,
                'pizza_price' => 8.35,
                'pizza_image' => 'images/cheese-pizza.png'
            ],
            // Популярные пиццы
            [
                'pizza_name' => 'Argentina',
                'pizza_description' => 'Filling: grilled beef, jalapeño peppers, corn, tomato sauce',
                'pizza_popular' => 1,
                'category_id' => $meatCat->category_id,
                'pizza_price' => 7.35,
                'pizza_image' => 'images/argentina-pizza.png'
            ],
            [
                'pizza_name' => 'Gribnaya',
                'pizza_description' => 'Filling: champignon, oyster mushrooms, mozzarella, cream sauce, dill',
                'pizza_popular' => 1,
                'category_id' => $mushCat->category_id,
                'pizza_price' => 6.35,
                'pizza_image' => 'images/gribnaya-pizza.png'
            ],
            [
                'pizza_name' => 'Tomato',
                'pizza_description' => 'Filling: sun-dried tomatoes, fresh tomatoes, basil, mozzarella, olive oil',
                'pizza_popular' => 1,
                'category_id' => $vegCat->category_id,
                'pizza_price' => 7.35,
                'pizza_image' => 'images/tomato-pizza.png'
            ],
            [
                'pizza_name' => 'Italian x2',
                'pizza_description' => 'Filling: Salami, portobello mushrooms, olives, cheese, tomato sauce',
                'pizza_popular' => 1,
                'category_id' => $meatCat->category_id,
                'pizza_price' => 8.35,
                'pizza_image' => 'images/italian-x2-pizza.png'
            ],
        ];
        
        foreach ($pizzas as $pizzaData) {
            $pizzaId = DB::table('pizzas')->insertGetId($pizzaData);
            
            // Связываем пиццу с размерами
            $this->linkPizzaSizes($pizzaId, $pizzaData['pizza_price']);
            
            // Связываем пиццу с базовыми ингредиентами
            $this->linkPizzaIngredients($pizzaId, $pizzaData['pizza_name']);
        }
    }
    
    private function linkPizzaSizes($pizzaId, $basePrice)
    {
        $sizes = DB::table('sizes')->get();
        
        foreach ($sizes as $size) {
            $price = $this->calculatePrice($basePrice, $size->size_name);
            
            DB::table('pizza_sizes')->insert([
                'pizza_id' => $pizzaId,
                'size_id' => $size->id_sizes,
                'price' => $price,
            ]);
        }
    }
    
    private function calculatePrice($basePrice, $sizeName)
    {
        $multipliers = [
            'Small' => 0.8,
            'Medium' => 1.0,
            'Large' => 1.3,
        ];
        
        return round($basePrice * $multipliers[$sizeName], 2);
    }
    
    private function linkPizzaIngredients($pizzaId, $pizzaName)
    {
        $ingredientMap = [
            'Italian' => ['Mozzarella'],
            'Meat' => ['Ham'],
            'Cheese' => ['Mozzarella'],
            'Gribnaya' => ['Mushrooms'],
            'Italian x2' => ['Mushrooms'],
        ];
        
        if (isset($ingredientMap[$pizzaName])) {
            foreach ($ingredientMap[$pizzaName] as $ingredientName) {
                $ingredient = DB::table('ingredients')
                    ->where('ingredients_name', $ingredientName)
                    ->first();
                
                if ($ingredient) {
                    DB::table('pizza_ingredients')->insert([
                        'pizza_id' => $pizzaId,
                        'ingredient_id' => $ingredient->id_ingredients,
                        'is_base' => 1,
                    ]);
                }
            }
        }
    }
}