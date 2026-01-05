// resources/js/cart.js

class Cart {
    constructor() {
        this.cartKey = 'plus_pizza_cart';
        this.cart = this.loadCart();
        this.init();
    }

    init() {
        this.updateCartCount();
        this.saveCart();
    }

    loadCart() {
        try {
            const cartData = localStorage.getItem(this.cartKey);
            return cartData ? JSON.parse(cartData) : [];
        } catch (error) {
            console.error('Error loading cart from localStorage:', error);
            return [];
        }
    }

    saveCart() {
        try {
            localStorage.setItem(this.cartKey, JSON.stringify(this.cart));
            this.updateCartCount();
            this.dispatchCartUpdate();
        } catch (error) {
            console.error('Error saving cart to localStorage:', error);
        }
    }

    updateCartCount() {
        const totalItems = this.getTotalItems();
        const cartCountElements = document.querySelectorAll('[data-js-cart-count]');
        
        cartCountElements.forEach(element => {
            element.textContent = totalItems;
            element.style.display = totalItems > 0 ? 'inline-block' : 'none';
        });
    }

    getTotalItems() {
        return this.cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
    }

    dispatchCartUpdate() {
        const event = new CustomEvent('cartUpdated', { 
            detail: { 
                cart: this.cart,
                totalItems: this.getTotalItems(),
                totalAmount: this.getTotalAmount()
            } 
        });
        document.dispatchEvent(event);
    }

    addPizza(pizzaData) {
        try {
            console.log('Adding pizza to cart:', pizzaData);
            
            const { 
                pizzaId, 
                pizzaName, 
                description, 
                price, 
                sizeId, 
                sizeName, 
                extraIngredients = [],
                quantity = 1
            } = pizzaData;

            // Рассчитываем общую стоимость
            const ingredientsTotal = this.calculateIngredientsTotal(extraIngredients);
            const totalPrice = (parseFloat(price) + ingredientsTotal) * quantity;
            
            // Создаем объект CartItem
            const cartItem = {
                id: Date.now() + Math.random().toString(36).substr(2, 9),
                pizza_id: parseInt(pizzaId),
                pizza_name: pizzaName,
                description: description,
                price: parseFloat(price),
                size_id: parseInt(sizeId),
                size_name: sizeName,
                quantity: quantity,
                extra_ingredients: extraIngredients || [],
                total_price: totalPrice,
                created_at: new Date().toISOString()
            };

            // Проверяем, есть ли уже такая пицца в корзине (с теми же параметрами)
            const existingItemIndex = this.findExistingItem(cartItem);
            
            if (existingItemIndex !== -1) {
                // Обновляем существующий элемент
                const existingItem = this.cart[existingItemIndex];
                existingItem.quantity += quantity;
                existingItem.total_price = (existingItem.price + this.calculateIngredientsTotal(existingItem.extra_ingredients)) * existingItem.quantity;
            } else {
                // Добавляем новый элемент
                this.cart.push(cartItem);
            }

            this.saveCart();
            console.log('Cart after addition:', this.cart);
            return true;
            
        } catch (error) {
            console.error('Error adding pizza to cart:', error);
            return false;
        }
    }

    findExistingItem(newItem) {
        return this.cart.findIndex(item => 
            item.pizza_id === newItem.pizza_id &&
            item.size_id === newItem.size_id &&
            JSON.stringify(item.extra_ingredients || []) === JSON.stringify(newItem.extra_ingredients || [])
        );
    }

    calculateIngredientsTotal(ingredients) {
        if (!ingredients || !Array.isArray(ingredients) || ingredients.length === 0) {
            return 0;
        }
        
        return ingredients.reduce((sum, ing) => {
            const price = parseFloat(ing.price) || 0;
            const quantity = parseInt(ing.quantity) || 1;
            return sum + (price * quantity);
        }, 0);
    }

    removeItem(itemId) {
        this.cart = this.cart.filter(item => item.id !== itemId);
        this.saveCart();
    }

    updateQuantity(itemId, newQuantity) {
        const itemIndex = this.cart.findIndex(item => item.id === itemId);
        if (itemIndex !== -1) {
            if (newQuantity <= 0) {
                this.removeItem(itemId);
            } else {
                const item = this.cart[itemIndex];
                item.quantity = newQuantity;
                item.total_price = (item.price + this.calculateIngredientsTotal(item.extra_ingredients)) * newQuantity;
                this.saveCart();
            }
        }
    }

    clearCart() {
        this.cart = [];
        this.saveCart();
    }

    getTotalAmount() {
        return this.cart.reduce((total, item) => {
            return total + (item.total_price || 0);
        }, 0).toFixed(2);
    }

    getItemCount() {
        return this.cart.length;
    }

    getCart() {
        return [...this.cart];
    }
}

// Создаем глобальный экземпляр корзины
window.CartManager = new Cart();

// Инициализируем при загрузке страницы
document.addEventListener('DOMContentLoaded', () => {
    console.log('CartManager initialized');
});