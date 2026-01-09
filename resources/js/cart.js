class Cart {
    constructor() {
        this.cartKey = 'plus_pizza_cart';
        this.promoKey = 'plus_pizza_promo';
        this.cart = this.loadCart();
        this.activePromo = this.loadPromo();
        console.log('Cart initialized:', this.cart);
    }

    loadCart() {
        try {
            const cartData = localStorage.getItem(this.cartKey);
            return cartData ? JSON.parse(cartData) : [];
        } catch (error) {
            console.error('Error loading cart:', error);
            return [];
        }
    }

    loadPromo() {
        try {
            const promoData = localStorage.getItem(this.promoKey);
            return promoData ? JSON.parse(promoData) : null;
        } catch (error) {
            console.error('Error loading promo:', error);
            return null;
        }
    }

    saveCart() {
        localStorage.setItem(this.cartKey, JSON.stringify(this.cart));
        this.updateCartCount();
        this.dispatchCartUpdate();
    }

    savePromo() {
        if (this.activePromo) {
            localStorage.setItem(this.promoKey, JSON.stringify(this.activePromo));
        } else {
            localStorage.removeItem(this.promoKey);
        }
        this.dispatchCartUpdate();
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
        const event = new Event('cartUpdated');
        document.dispatchEvent(event);
    }

    addPizza(pizzaData) {
        console.log('Adding pizza:', pizzaData);
        
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

      
        const ingredientsTotal = this.calculateIngredientsTotal(extraIngredients);
        const totalPrice = (parseFloat(price) + ingredientsTotal) * quantity;
        
       
        const cartItem = {
            id: Date.now(),
            pizza_id: parseInt(pizzaId),
            pizza_name: pizzaName,
            description: description,
            price: parseFloat(price),
            size_id: parseInt(sizeId),
            size_name: sizeName,
            quantity: quantity,
            extra_ingredients: extraIngredients,
            total_price: totalPrice
        };

        this.cart.push(cartItem);
        this.saveCart();
        
        return true;
    }

    calculateIngredientsTotal(ingredients) {
        if (!ingredients || !Array.isArray(ingredients)) return 0;
        return ingredients.reduce((sum, ing) => sum + (ing.price * ing.quantity), 0);
    }

    removeItem(itemId) {
        this.cart = this.cart.filter(item => item.id !== itemId);
        this.saveCart();
    }

    updateQuantity(itemId, newQuantity) {
        const item = this.cart.find(item => item.id === itemId);
        if (item) {
            if (newQuantity <= 0) {
                this.removeItem(itemId);
            } else {
                item.quantity = newQuantity;
                const ingredientsTotal = this.calculateIngredientsTotal(item.extra_ingredients);
                item.total_price = (item.price + ingredientsTotal) * newQuantity;
                this.saveCart();
            }
        }
    }

    clearCart() {
        this.cart = [];
        this.saveCart();
    }

    getTotalAmount() {
        return this.cart.reduce((total, item) => total + (item.total_price || 0), 0);
    }

    getItemCount() {
        return this.cart.length;
    }

    getCart() {
        return [...this.cart];
    }

   
    applyPromoCode(code) {
        const promoCodes = {
            'TEST10': { name: 'Test 10%', discount: 0.10 },
            'PIZZA20': { name: 'Pizza 20%', discount: 0.20 },
            'WELCOME15': { name: 'Welcome 15%', discount: 0.15 }
        };

        const promoCode = code.toUpperCase().trim();
        
        if (!promoCodes[promoCode]) {
            return { success: false, message: 'Invalid promo code' };
        }

        this.activePromo = {
            code: promoCode,
            ...promoCodes[promoCode]
        };

        this.savePromo();
        
        return { 
            success: true, 
            message: `Promo code "${this.activePromo.name}" applied!`,
            promo: this.activePromo 
        };
    }

    removePromoCode() {
        this.activePromo = null;
        this.savePromo();
        return { success: true, message: 'Promo code removed' };
    }

    getDiscountAmount() {
        if (!this.activePromo) return 0;
        const subtotal = this.getTotalAmount();
        return subtotal * this.activePromo.discount;
    }

    getTotalWithDiscount() {
        const subtotal = this.getTotalAmount();
        const discount = this.getDiscountAmount();
        return subtotal - discount;
    }
}

if (!window.CartManager) {
    window.CartManager = new Cart();
    console.log('CartManager created:', window.CartManager);
}


document.addEventListener('DOMContentLoaded', () => {
    if (window.CartManager) {
        window.CartManager.updateCartCount();
    }
});