<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Plus Pizza</title>
    @vite(['resources/scss/favourites.scss'])
</head>
<body>
    <header class="header">
        <h1 class="header__title">Корзина</h1>
        <div class="header__buttons">
            <a href="{{ url('/') }}" class="header__home-btn" aria-label="Go to home page" title="Go to home page">
                <img src="{{ asset('icons/Home.svg') }}" loading="lazy" alt="Home" width="40" height="40">
            </a>
            <button type="button" class="header__clean-btn" aria-label="Clear cart" title="Clear cart" data-js-button-clean>
                <img src="{{ asset('icons/trash.svg') }}" loading="lazy" alt="Clear cart" width="40" height="40">
            </button>
        </div>
    </header>
    
    <main class="main">
        <!-- Секция с пиццами в корзине -->
        <section class="main__favourites-pizza" data-js-cart-items>
            <!-- Динамическое содержимое -->
        </section>
        
        <!-- Блок пустой корзины -->
        <div class="main__favourites" data-js-empty-cart>
            <h2 class="main__title">The basket is empty</h2>
            <p class="main__description">Your cart is empty. Go to the "Menu" section and add the dishes you like</p>
            <br>
            <a href="{{ url('/') }}#menu" class="main__link-menu">Go to the menu</a>
        </div>
        
        <!-- Итоговая сумма -->
        <table class="main__table" data-js-total-section>
            <tr>
                <th>Total amount</th>
            </tr>
            <tr>
                <td data-js-total-amount>0 $</td>
            </tr>
        </table>
        
        <!-- Промокод -->
        <input class="main__input-promocode" type="text" placeholder="Enter a promo code" data-js-input-promocode>
        
        <!-- Кнопка заказа -->
        <button class="main__buy-button" data-js-button-place-an-order>Place an order</button>
    </main>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Cart page loaded');
            
            // Проверяем доступность CartManager
            if (!window.CartManager) {
                console.error('ERROR: CartManager is not available!');
                alert('Error: Cart system not loaded. Please refresh the page.');
                return;
            }
            
            console.log('CartManager found:', window.CartManager);
            
            const manager = new CartPageManager();
            manager.init();
        });

        class CartPageManager {
            constructor() {
                this.cart = window.CartManager;
                this.elements = {};
                this.initElements();
            }
            
            initElements() {
                // Находим все элементы
                this.elements.cartItems = document.querySelector('[data-js-cart-items]');
                this.elements.emptyCart = document.querySelector('[data-js-empty-cart]');
                this.elements.totalAmount = document.querySelector('[data-js-total-amount]');
                this.elements.totalSection = document.querySelector('[data-js-total-section]');
                this.elements.clearButton = document.querySelector('[data-js-button-clean]');
                this.elements.orderButton = document.querySelector('[data-js-button-place-an-order]');
                this.elements.promocodeInput = document.querySelector('[data-js-input-promocode]');
                
                console.log('Elements found:', this.elements);
            }
            
            init() {
                console.log('Initializing cart page...');
                console.log('Cart items:', this.cart.getCart());
                
                this.renderCart();
                this.updateUI();
                this.bindEvents();
                
                // Слушаем обновления корзины
                document.addEventListener('cartUpdated', () => {
                    console.log('Cart updated event received');
                    this.renderCart();
                    this.updateUI();
                });
            }
            
            renderCart() {
                const cartItems = this.cart.getCart();
                const container = this.elements.cartItems;
                
                if (!container) {
                    console.error('Cart container not found');
                    return;
                }
                
                container.innerHTML = '';
                
                if (cartItems.length === 0) {
                    return;
                }
                
                cartItems.forEach(item => {
                    const itemElement = this.createCartItemElement(item);
                    container.appendChild(itemElement);
                });
            }
            
            createCartItemElement(item) {
                const article = document.createElement('article');
                article.className = 'main__favourites-pizza-card';
                article.dataset.itemId = item.id;
                
                // Простая карточка товара
                article.innerHTML = `
                    <div class="main__wrapper">
                        <img src="{{ asset('images/argentina-pizza.png') }}" loading="lazy" alt="${item.pizza_name}" class="main__pizza-img" width="200" height="200">
                        <div class="main__container">
                            <div class="main__favourites-pizza-container">
                                <h3 class="main__favourites-pizza-name">${item.pizza_name}</h3>
                                <p class="main__favourites-pizza-description">${item.description}</p>
                                <p class="main__size">Size: ${item.size_name}</p>
                            </div>
                            <div class="main__content">
                                <p class="main__price">${item.total_price.toFixed(2)} $</p>
                                <div class="main__quantity-content">
                                    <button type="button" class="main__reduce-pizza" data-action="decrease"><img src="{{ asset('icons/remove-icon.svg') }}" class="main__reduce-pizza-svg" loading="lazy" alt="Remove" width="25" height="25"></button>
                                    <p class="main__quantity">${item.quantity}</p>
                                    <button type="button" class="main__add-pizza" data-action="increase"><img src="{{ asset('icons/add-icon.svg') }}" class="main__add-pizza-svg" loading="lazy" alt="Add" width="25" height="25"></button>
                                    <button type="button" class="main__remove-pizza" data-action="remove"> <img src="{{ asset('icons/udalit_6hf5y934pji2 (1).svg') }}" loading="lazy" alt="Remove" width="20" height="20"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                // Добавляем обработчики
                this.bindItemEvents(article, item.id);
                return article;
            }
            
            bindItemEvents(element, itemId) {
                const increaseBtn = element.querySelector('[data-action="increase"]');
                const decreaseBtn = element.querySelector('[data-action="decrease"]');
                const removeBtn = element.querySelector('[data-action="remove"]');
                
                increaseBtn?.addEventListener('click', () => {
                    const item = this.cart.getCart().find(item => item.id === itemId);
                    if (item) {
                        this.cart.updateQuantity(itemId, item.quantity + 1);
                    }
                });
                
                decreaseBtn?.addEventListener('click', () => {
                    const item = this.cart.getCart().find(item => item.id === itemId);
                    if (item && item.quantity > 1) {
                        this.cart.updateQuantity(itemId, item.quantity - 1);
                    }
                });
                
                removeBtn?.addEventListener('click', () => {
                    if (confirm('Remove this item?')) {
                        this.cart.removeItem(itemId);
                    }
                });
            }
            
            // updateUI() {
            //     const hasItems = this.cart.getItemCount() > 0;
                
            //     console.log('Updating UI, hasItems:', hasItems);
                
            //     // Блок пустой корзины
            //     if (this.elements.emptyCart) {
            //         this.elements.emptyCart.style.display = hasItems ? 'none' : 'block';
            //     }
                
            //     // Итоговая сумма
            //     if (this.elements.totalSection) {
            //         this.elements.totalSection.style.display = hasItems ? 'table' : 'none';
            //     }
                
            //     // Промокод
            //     if (this.elements.promocodeInput) {
            //         this.elements.promocodeInput.style.display = hasItems ? 'block' : 'none';
                    
            //         // Обновляем placeholder
            //         if (this.cart.activePromo) {
            //             this.elements.promocodeInput.placeholder = this.cart.activePromo.name;
            //             this.elements.promocodeInput.value = this.cart.activePromo.code;
            //         } else {
            //             this.elements.promocodeInput.placeholder = 'Enter a promo code';
            //             this.elements.promocodeInput.value = '';
            //         }
            //     }
                
            //     // Кнопка заказа
            //     if (this.elements.orderButton) {
            //         this.elements.orderButton.style.display = hasItems ? 'block' : 'none';
            //     }
                
            //     // Обновляем сумму
            //     this.updateTotalAmount();
            // }

            updateUI() {
                const hasItems = this.cart.getItemCount() > 0;
                
                // Блок пустой корзины - используем классы
                if (this.elements.emptyCart) {
                    if (hasItems) {
                        this.elements.emptyCart.classList.add('hidden');
                    } else {
                        this.elements.emptyCart.classList.remove('hidden');
                    }
                }
                
                // Итоговая сумма
                if (this.elements.totalSection) {
                    if (hasItems) {
                        this.elements.totalSection.classList.remove('hidden');
                    } else {
                        this.elements.totalSection.classList.add('hidden');
                    }
                }
                
                // Промокод
                if (this.elements.promocodeInput) {
                    if (hasItems) {
                        this.elements.promocodeInput.classList.remove('hidden');
                    } else {
                        this.elements.promocodeInput.classList.add('hidden');
                    }
                    
                    // Обновляем placeholder
                    if (this.cart.activePromo) {
                        this.elements.promocodeInput.placeholder = this.cart.activePromo.name;
                        this.elements.promocodeInput.value = this.cart.activePromo.code;
                    } else {
                        this.elements.promocodeInput.placeholder = 'Enter a promo code';
                        this.elements.promocodeInput.value = '';
                    }
                }
                
                // Кнопка заказа
                if (this.elements.orderButton) {
                    if (hasItems) {
                        this.elements.orderButton.classList.remove('hidden');
                    } else {
                        this.elements.orderButton.classList.add('hidden');
                    }
                }
                
                // Обновляем сумму
                this.updateTotalAmount();
            }
                        
            updateTotalAmount() {
                if (!this.elements.totalAmount) return;
                
                const total = this.cart.getTotalAmount();
                const discount = this.cart.getDiscountAmount();
                const finalTotal = total - discount;
                
                if (this.cart.activePromo) {
                    this.elements.totalAmount.innerHTML = `
                        <div>
                            <div style="text-decoration: line-through; color: #999;">${total.toFixed(2)} $</div>
                            <div style="color: #FF6B35; font-size: 18px;">${finalTotal.toFixed(2)} $</div>
                            <div style="font-size: 12px; color: green;">Promo: ${this.cart.activePromo.name}</div>
                        </div>
                    `;
                } else {
                    this.elements.totalAmount.textContent = total.toFixed(2) + ' $';
                }
            }
            
            bindEvents() {
                // Очистка корзины
                this.elements.clearButton?.addEventListener('click', () => {
                    if (this.cart.getItemCount() === 0) {
                        alert('Cart is already empty!');
                        return;
                    }
                    
                    if (confirm('Clear cart?')) {
                        this.cart.clearCart();
                    }
                });
                
                // Оформление заказа
                this.elements.orderButton?.addEventListener('click', () => {
                    if (this.cart.getItemCount() === 0) {
                        alert('Cart is empty!');
                        return;
                    }
                    
                    const total = this.cart.getTotalWithDiscount();
                    alert(`Order placed! Total: ${total.toFixed(2)} $`);
                    this.cart.clearCart();
                    this.cart.removePromoCode();
                });
                
                // Промокод
                this.elements.promocodeInput?.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        this.handlePromoCode();
                    }
                });
            }
            
            handlePromoCode() {
                const code = this.elements.promocodeInput.value.trim();
                
                if (!code) {
                    // Если input пустой и есть промокод - удаляем его
                    if (this.cart.activePromo) {
                        if (confirm(`Remove ${this.cart.activePromo.name}?`)) {
                            this.cart.removePromoCode();
                            this.updateUI();
                        }
                    }
                    return;
                }
                
                const result = this.cart.applyPromoCode(code);
                
                if (result.success) {
                    alert(result.message);
                    this.updateUI();
                } else {
                    alert(result.message);
                    this.elements.promocodeInput.value = '';
                    this.elements.promocodeInput.focus();
                }
            }
        }
    </script>
    
    @vite(['resources/js/cart.js'])
</body>
</html>