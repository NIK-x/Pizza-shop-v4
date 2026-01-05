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
        
        <!-- Итоговая сумма (скрывается при пустой корзине) -->
        <table class="main__table" data-js-total-section style="display: none;">
            <tr>
                <th>Total amount</th>
            </tr>
            <tr>
                <td data-js-total-amount>0 $</td>
            </tr>
        </table>
        
    
        <input class="main__input-promocode" type="text" placeholder="Enter a promo code" data-js-input-promocode style="display: none;">
        
     
        <button class="main__buy-button" data-js-button-place-an-order style="display: none;">Place an order</button>
    </main>
    
    <script>
        // Подключаем CartManager из cart.js
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Cart page loaded');
            
            // Проверяем доступность CartManager
            if (!window.CartManager) {
                console.error('CartManager is not available on cart page');
                return;
            }
            
            const favouritesManager = new FavouritesManager();
            favouritesManager.init();
        });

        class FavouritesManager {
            constructor() {
                this.cart = window.CartManager;
                this.selectors = {
                    cartItems: '[data-js-cart-items]',
                    emptyCart: '[data-js-empty-cart]',
                    totalAmount: '[data-js-total-amount]',
                    totalSection: '[data-js-total-section]',
                    clearButton: '[data-js-button-clean]',
                    orderButton: '[data-js-button-place-an-order]',
                    promocodeInput: '[data-js-input-promocode]'
                };
                
                this.initElements();
            }
            
            initElements() {
                this.cartItemsElement = document.querySelector(this.selectors.cartItems);
                this.emptyCartElement = document.querySelector(this.selectors.emptyCart);
                this.totalAmountElement = document.querySelector(this.selectors.totalAmount);
                this.totalSectionElement = document.querySelector(this.selectors.totalSection);
                this.clearButton = document.querySelector(this.selectors.clearButton);
                this.orderButton = document.querySelector(this.selectors.orderButton);
                this.promocodeInput = document.querySelector(this.selectors.promocodeInput);
                
                console.log('Elements initialized:', {
                    cartItemsElement: !!this.cartItemsElement,
                    emptyCartElement: !!this.emptyCartElement,
                    totalAmountElement: !!this.totalAmountElement,
                    cartItems: this.cart?.getCart()?.length || 0
                });
            }
            
            init() {
                console.log('Initializing FavouritesManager with cart:', this.cart.getCart());
                this.renderCart();
                this.updateUI();
                this.bindEvents();
                
                // Слушаем обновления корзины
                document.addEventListener('cartUpdated', () => {
                    console.log('Cart updated event received on cart page');
                    this.renderCart();
                    this.updateUI();
                });
            }
            
            renderCart() {
                const cartItems = this.cart.getCart();
                console.log('Rendering cart items:', cartItems);
                
                if (!this.cartItemsElement) {
                    console.error('Cart items element not found');
                    return;
                }
                
                this.cartItemsElement.innerHTML = '';
                
                if (cartItems.length === 0) {
                    console.log('Cart is empty, not rendering items');
                    return;
                }
                
                cartItems.forEach(item => {
                    const itemElement = this.createCartItemElement(item);
                    this.cartItemsElement.appendChild(itemElement);
                });
            }
            
            createCartItemElement(item) {
                const article = document.createElement('article');
                article.className = 'main__favourites-pizza-card';
                article.dataset.itemId = item.id;
                
                // Определяем путь к изображению
                const getImagePath = (pizzaId) => {
                    const images = {
                        1: 'images/italian-pizza.png',
                        2: 'images/venecia-pizza.png',
                        3: 'images/meat-pizza.png',
                        4: 'images/cheese-pizza.png',
                        5: 'images/argentina-pizza.png',
                        6: 'images/gribnaya-pizza.png',
                        7: 'images/tomato-pizza.png',
                        8: 'images/italian-x2-pizza.png'
                    };
                    return images[pizzaId] || 'images/argentina-pizza.png';
                };
                
                const imagePath = getImagePath(item.pizza_id);
                const imageUrl = `{{ asset('${imagePath}') }}`;
                
                article.innerHTML = `
                    <div class="main__wrapper">
                        <img src="${imageUrl}" loading="lazy" alt="${item.pizza_name}" class="main__pizza-img" width="200" height="200">
                        <div class="main__container">
                            <div class="main__favourites-pizza-container">
                                <h3 class="main__favourites-pizza-name">${item.pizza_name}</h3>
                                <p class="main__favourites-pizza-description">${item.description}</p>
                                <p class="main__size">Size: ${item.size_name}</p>
                                ${this.createIngredientsHTML(item.extra_ingredients)}
                            </div>
                            <div class="main__content">
                                <p class="main__price" data-js-price>${item.total_price.toFixed(2)} $</p>
                                <div class="main__quantity-content">
                                    <button type="button" class="main__reduce-pizza" title="Remove one pizza" aria-label="Remove one pizza" data-action="decrease">
                                        <img src="{{ asset('icons/remove-icon.svg') }}" class="main__reduce-pizza-svg" loading="lazy" alt="Remove" width="25" height="25">
                                    </button>
                                    <p class="main__quantity" data-js-count>${item.quantity}</p>
                                    <button type="button" class="main__add-pizza" title="Add one pizza" aria-label="Add one pizza" data-action="increase">
                                        <img src="{{ asset('icons/add-icon.svg') }}" class="main__add-pizza-svg" loading="lazy" alt="Add" width="25" height="25">
                                    </button>
                                    <button type="button" class="main__remove-pizza" title="Remove pizza" aria-label="Remove pizza" data-action="remove">
                                        <img src="{{ asset('icons/udalit_6hf5y934pji2 (1).svg') }}" loading="lazy" alt="Remove" width="20" height="20">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                this.bindItemEvents(article, item.id);
                return article;
            }
            
            createIngredientsHTML(ingredients) {
                if (!ingredients || !Array.isArray(ingredients) || ingredients.length === 0) {
                    return '';
                }
                
                const ingredientsList = ingredients.map(ing => 
                    `${ing.name} (${ing.quantity}x)`
                ).join(', ');
                
                return `<p class="main__ingredients">Extra: ${ingredientsList}</p>`;
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
                    } else if (item && item.quantity === 1) {
                        if (confirm('Remove this item from cart?')) {
                            this.cart.removeItem(itemId);
                        }
                    }
                });
                
                removeBtn?.addEventListener('click', () => {
                    if (confirm('Remove this item from cart?')) {
                        this.cart.removeItem(itemId);
                    }
                });
            }
            
            bindEvents() {
                // Очистка корзины
                this.clearButton?.addEventListener('click', () => {
                    if (this.cart.getItemCount() === 0) {
                        alert('Cart is already empty!');
                        return;
                    }
                    
                    if (confirm('Are you sure you want to clear your cart?')) {
                        this.cart.clearCart();
                    }
                });
                
                // Оформление заказа
                this.orderButton?.addEventListener('click', () => {
                    if (this.cart.getItemCount() === 0) {
                        alert('Your cart is empty!');
                        return;
                    }
                    
                    // Здесь можно добавить логику оформления заказа
                    const total = this.cart.getTotalAmount();
                    alert(`Order placed successfully! Total: ${total} $`);
                    this.cart.clearCart();
                });
            }
            
            updateUI() {
                const hasItems = this.cart.getItemCount() > 0;
                console.log('Updating UI, hasItems:', hasItems, 'item count:', this.cart.getItemCount());
                
                // Показываем/скрываем блок пустой корзины
                if (this.emptyCartElement) {
                    this.emptyCartElement.style.display = hasItems ? 'none' : 'block';
                    console.log('Empty cart display:', this.emptyCartElement.style.display);
                }
                
                // Показываем/скрываем итоговую сумму
                if (this.totalSectionElement) {
                    this.totalSectionElement.style.display = hasItems ? 'table' : 'none';
                }
                
                // Показываем/скрываем промокод
                if (this.promocodeInput) {
                    this.promocodeInput.style.display = hasItems ? 'block' : 'none';
                }
                
                // Показываем/скрываем кнопку заказа
                if (this.orderButton) {
                    this.orderButton.style.display = hasItems ? 'block' : 'none';
                    this.orderButton.disabled = !hasItems;
                }
                
                // Обновляем общую сумму
                if (this.totalAmountElement) {
                    this.totalAmountElement.textContent = this.cart.getTotalAmount() + ' $';
                }
            }
        }
    </script>
    
    @vite(['resources/js/cart.js'])
</body>
</html>