import './cart.js';

class Header {
    selectors = {
        burgerButton: "[data-js-burger-button]",
        loginButton: "[data-js-login-button]",
        popUp: "[data-js-popUp]",
        headerOverlay: "[data-js-header-overlay]",
        menuList: "[data-js-menu-list]",
        items: "[data-js-item]",
        closeButton: "[data-js-close-button]",
        backDrop: "[data-js-backdrop]"
    }

    states = {
        show: "show",
        hidden: "hidden",
        noScroll: "no-scroll",
        click: "click"
    }

    constructor() {
        this.menuList = document.querySelector(this.selectors.menuList);
        this.headerOverlay = document.querySelector(this.selectors.headerOverlay);
        this.popUp = document.querySelector(this.selectors.popUp);
        this.closeButton = this.popUp.querySelector(this.selectors.closeButton);
        this.loginButton = document.querySelector(this.selectors.loginButton);
        this.burgerButton = document.querySelector(this.selectors.burgerButton);
        this.items = document.querySelector(this.selectors.items);
        this.backDrop = document.querySelector(this.selectors.backDrop);
        this.init();
    }

    init() {
        this.burgerMenu();
        this.login();
    }

    // toggleClass(element) {
    //     element.classList.toggle("is-active");
    // }




    burgerMenu() {
        this.burgerButton.addEventListener("click", () => {
            this.headerOverlay.classList.add("is-active");
            this.menuList.classList.add("is-active");
            this.items.forEach((item) => {
                item.classList.add("click");
            });

            this.headerOverlay.classList.add("click");
            this.headerOverlay.classList.add(this.states.noScroll);
            this.m
        });

        this.headerOverlay.addEventListener("click", () => {
            this.headerOverlay.classList.remove("is-active");
            this.menuList.classList.remove("is-active")
            document.body.classList.remove(this.states.noScroll);
        })
    }

    login() {
        this.loginButton.addEventListener("click", () => {
            this.popUp.classList.remove(this.states.hidden);
            document.body.classList.add(this.states.noScroll);
            this.backDrop.classList.remove(this.states.hidden);
        });
        this.closeButton.addEventListener("click", () => {
            this.popUp.classList.add(this.states.hidden);
            document.body.classList.remove(this.states.noScroll);
            this.backDrop.classList.add(this.states.hidden);
        })
    }
}

new Header().init();


class FilterPizza {
    selectors = {
        filterButtons: "[data-js-button-filter]",
        pizzaCard: "[data-js-pizza-card]",
        pizzaPopularBox: "[data-js-popular]",
        allPizza: "[data-js-all-pizza]",
        blockPizza: "[data-js-block-pizza]",
    }

    states = {
        isActive: "is-active",
        isHidden: "hidden",
        isShow: "show",
        isFilter: "filter",
    }

    constructor() {
        this.pizzaCard = document.querySelectorAll(this.selectors.pizzaCard)
        this.filterButtons = document.querySelectorAll(this.selectors.filterButtons);
        this.pizzaPopularBox = document.querySelector(this.selectors.pizzaPopularBox);

        this.blockPizza = document.querySelectorAll(this.selectors.blockPizza);
        this.allPizza = document.querySelector(this.selectors.allPizza);

        this.getFilterPizza();
    }

    updateButton(activeButton) {
        this.filterButtons.forEach((button) => button.classList.remove(this.states.isActive));
        activeButton.classList.add(this.states.isActive)
    }

    showAll() {
        this.allPizza.classList.remove(this.states.isFilter);
        this.blockPizza.forEach(element => element.classList.remove("display-contents"));
        this.pizzaPopularBox.classList.remove(this.states.isHidden);

        this.pizzaCard.forEach((pizza) => {
            if (pizza.classList.contains(this.states.isHidden)) {
                pizza.classList.remove(this.states.isHidden);
            }
        })
    }

    showFilterPizza(filterValue) {
        this.pizzaCard.forEach((pizza) => {
            const pizzaCategoryValue = pizza.dataset.category;
            this.allPizza.classList.add(this.states.isFilter);
            this.blockPizza.forEach(element => element.classList.add("display-contents"));
            if (!(pizzaCategoryValue.includes(filterValue))) {
                pizza.classList.add(this.states.isHidden);
            } else {
                pizza.classList.remove(this.states.isHidden);
            }
            this.pizzaPopularBox.classList.add(this.states.isHidden);
        })
    }

    getFilterPizza() {
        this.filterButtons.forEach((button) => {
            button.addEventListener("click", () => {
                const buttonFilterValue = button.dataset.filter;
                this.updateButton(button)

                if (buttonFilterValue == "all") {
                    this.showAll();
                } else {
                    this.showFilterPizza(buttonFilterValue);
                }
            });

        });
    }

}
new FilterPizza();





class More {
    selectors = {
        popUp: "[data-js-more-popUp]",
        title: "[data-js-title]",
        description: "[data-js-description]",
        moreButtons: "[data-js-more-buttons]",
    }

    states = {
        hidden: "hidden"
    }

    categoryes = {
        coocking: "Learn the secrets behind our perfect pizza! Join our interactive cooking sessions where our chefs demonstrate traditional techniques, share tips on dough fermentation, and guide you through crafting your own delicious creation. A fun, hands-on experience for pizza lovers of all ages.",
        ourBlog: "Dive into stories, recipes, and behind-the-scenes moments from our pizzeria! From seasonal specials to chef interviews and cooking hacks, our blog is your go-to spot for everything cheesy, crispy, and fresh.",
        twoPizza: "Double the delight! Every Thursday, enjoy our signature Two-for-One deal—order any large pizza and get another one of equal or lesser value absolutely free. Perfect for sharing with friends or saving for later.",
        kitchenTour: "Ever wondered what goes on behind the counter? Take a guided tour of our kitchen! See where the magic happens, learn about our ingredients, and watch our team craft your pizza from scratch. A great experience for families and curious foodies.",
        freeCoffe: "Order three pizzas and receive a complimentary cup of our freshly brewed artisan coffee. The perfect pairing to round off your meal—warm, rich coffee alongside our hot, flavorful pizza.",
        instagram: "Follow us for daily mouth-watering photos, event announcements, and special offers! Stay connected, tag us in your pizza moments, and get a chance to be featured on our page.",
        chooseUs: "We love hearing your stories! Share how you discovered our pizzeria—whether through a friend, a food blog, or just by walking by—and get a chance to win a free dessert on your next visit.",
    }

    constructor() {
        this.popUp = document.querySelector(this.selectors.popUp);
        this.title = this.popUp.querySelector(this.selectors.title);
        this.description = this.popUp.querySelector(this.selectors.description);
        this.moreButtons = document.querySelectorAll(this.selectors.moreButtons);
    }


    init() {
        this.getMoreInformation();
    }

    getMoreInformation() {
        this.moreButtons.forEach((button) => {
            const buttonCategoryValue = button.dataset.category;
            button.addEventListener("click", () => {
                switch (buttonCategoryValue) {
                    case "coocking":
                        this.title.textContent = "How we coocking";
                        this.description.textContent = this.categoryes.coocking;
                        break;
                    case "our-blog":
                        this.title.textContent = "Our blog";
                        this.description.textContent = this.categoryes.ourBlog;
                        break;
                    case "two-pizza":
                        this.title.textContent = "Two pizza for 1 price";
                        this.description.textContent = this.categoryes.twoPizza;
                        break;
                    case "kitchen-tour":
                        this.title.textContent = "Kitchen tour";
                        this.description.textContent = this.categoryes.kitchenTour;
                        break;
                    case "free-coffe":
                        this.title.textContent = "Free coffe for 3 pizza";
                        this.description.textContent = this.categoryes.freeCoffe;
                        break;
                    case "instagram":
                        this.title.textContent = "Our instagram";
                        this.description.textContent = this.categoryes.instagram;
                        break;
                    case "choose-us":
                        this.title.textContent = "Where are you choose us?";
                        this.description.textContent = this.categoryes.chooseUs;
                        break;
                }
                this.popUp.classList.remove(this.states.hidden);
            });
        });

        this.popUp.addEventListener("click", () => {
            this.popUp.classList.add(this.states.hidden);
        });
    }
}

new More().init();

class PizzaMenu {
    selectors = {
        sizeCheckboxes: '.pizza-menu__checkbox',
        quantityButtons: '[data-action="increase"], [data-action="decrease"]',
        ingredientsButtons: '.pizza-menu__button-add-ingredients',
        ingredientsPopup: '[data-js-ingredients-popup]',
        closeIngredientsButton: '[data-js-close-ingredients]',
        orderButtons: '.pizza-menu__add-to-favorites',
        ingredientAddButtons: '.ingredients-popUp__button-add',
        ingredientRemoveButtons: '.ingredients-popUp__button-remove',
        ingredientAddCountButtons: '.ingredients-popUp__button-add-count',
        ingredientCounts: '.ingredients-popUp__count',
        totalAmount: '.ingredients-popUp__total-amount',
        addToOrderButton: '.ingredients-popUp__button-order'
    }

    constructor() {
        this.currentPizzaId = null;
        this.selectedIngredients = {};
        this.init();
    }

    init() {
        this.bindEvents();
    }

    bindEvents() {

        document.addEventListener('change', (e) => {
            if (e.target.matches(this.selectors.sizeCheckboxes)) {
                this.updatePriceForSelectedSize(e.target);
            }
        });


        document.addEventListener('click', (e) => {
            if (e.target.closest(this.selectors.quantityButtons)) {
                const button = e.target.closest(this.selectors.quantityButtons);
                const action = button.dataset.action;
                this.updateQuantity(button, action);
            }
        });

        document.addEventListener('click', (e) => {
            if (e.target.closest(this.selectors.ingredientsButtons)) {
                const button = e.target.closest(this.selectors.ingredientsButtons);
                this.currentPizzaId = button.dataset.pizzaId;
                this.openIngredientsPopup();
            }
        });


        document.addEventListener('click', (e) => {
            if (e.target.closest(this.selectors.closeIngredientsButton) ||
                (e.target.closest(this.selectors.ingredientsPopup) &&
                    e.target === document.querySelector(this.selectors.ingredientsPopup))) {
                this.closeIngredientsPopup();
            }
        });


        document.addEventListener('click', (e) => {
            if (e.target.closest(this.selectors.ingredientAddButtons)) {
                const button = e.target.closest(this.selectors.ingredientAddButtons);
                this.addIngredient(button);
            }

            if (e.target.closest(this.selectors.ingredientRemoveButtons)) {
                const button = e.target.closest(this.selectors.ingredientRemoveButtons);
                this.removeIngredient(button);
            }

            if (e.target.closest(this.selectors.ingredientAddCountButtons)) {
                const button = e.target.closest(this.selectors.ingredientAddCountButtons);
                this.addIngredientCount(button);
            }
        });


        document.addEventListener('click', (e) => {
            if (e.target.closest(this.selectors.addToOrderButton)) {
                this.addIngredientsToPizza();
            }
        });


        document.addEventListener('click', (e) => {
            if (e.target.closest(this.selectors.orderButtons)) {
                e.preventDefault();
                this.addToCart(e.target);
            }
        });
    }

    updatePriceForSelectedSize(checkbox) {
        const card = checkbox.closest('[data-js-pizza-card]');
        const priceElement = card.querySelector('.pizza-menu__price');
        const basePrice = parseFloat(priceElement.dataset.basePrice);
        const selectedPrice = parseFloat(checkbox.dataset.price);
        const quantity = parseInt(card.querySelector('.pizza-menu__count').textContent);


        const totalPrice = selectedPrice * quantity;
        priceElement.innerHTML = `${totalPrice.toFixed(2)} <sup>$</sup>`;

        card.dataset.selectedSizeId = checkbox.dataset.sizeId;
        card.dataset.selectedSizePrice = selectedPrice;
    }

    updateQuantity(button, action) {
        const card = button.closest('[data-js-pizza-card]');
        const countElement = card.querySelector('.pizza-menu__count');
        const priceElement = card.querySelector('.pizza-menu__price');
        const basePrice = parseFloat(priceElement.dataset.basePrice);

        let count = parseInt(countElement.textContent);

        if (action === 'increase') {
            count++;
        } else if (action === 'decrease' && count > 1) {
            count--;
        }

        countElement.textContent = count;


        const selectedCheckbox = card.querySelector(`${this.selectors.sizeCheckboxes}:checked`);
        if (selectedCheckbox) {
            const selectedPrice = parseFloat(selectedCheckbox.dataset.price);
            const totalPrice = selectedPrice * count;
            priceElement.innerHTML = `${totalPrice.toFixed(2)} <sup>$</sup>`;
        } else {

            const totalPrice = basePrice * count;
            priceElement.innerHTML = `${totalPrice.toFixed(2)} <sup>$</sup>`;
        }
    }

    openIngredientsPopup() {
        const popup = document.querySelector(this.selectors.ingredientsPopup);
        if (popup) {
            popup.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            this.resetIngredients();
        }
    }

    closeIngredientsPopup() {
        const popup = document.querySelector(this.selectors.ingredientsPopup);
        if (popup) {
            popup.classList.add('hidden');
            document.body.style.overflow = '';
            this.currentPizzaId = null;
        }
    }

    addIngredient(button) {
        const ingredientId = button.dataset.ingredientId;
        const price = parseFloat(button.dataset.price);
        const name = button.dataset.name;

        if (!this.selectedIngredients[ingredientId]) {
            this.selectedIngredients[ingredientId] = {
                name: name,
                price: price,
                quantity: 1
            };
        } else {
            this.selectedIngredients[ingredientId].quantity++;
        }

        this.updateIngredientCount(ingredientId);
        this.updateTotalAmount();
    }

    removeIngredient(button) {
        const ingredientId = button.dataset.ingredientId;

        if (this.selectedIngredients[ingredientId] && this.selectedIngredients[ingredientId].quantity > 0) {
            this.selectedIngredients[ingredientId].quantity--;

            if (this.selectedIngredients[ingredientId].quantity === 0) {
                delete this.selectedIngredients[ingredientId];
            }

            this.updateIngredientCount(ingredientId);
            this.updateTotalAmount();
        }
    }

    addIngredientCount(button) {
        const ingredientId = button.dataset.ingredientId;
        const ingredientElement = button.closest('.ingredients-popUp__box');
        const addButton = ingredientElement.querySelector('.ingredients-popUp__button-add');
        const price = parseFloat(addButton.dataset.price);
        const name = addButton.dataset.name;

        if (!this.selectedIngredients[ingredientId]) {
            this.selectedIngredients[ingredientId] = {
                name: name,
                price: price,
                quantity: 1
            };
        } else {
            this.selectedIngredients[ingredientId].quantity++;
        }

        this.updateIngredientCount(ingredientId);
        this.updateTotalAmount();
    }

    updateIngredientCount(ingredientId) {
        const countElement = document.querySelector(`.ingredients-popUp__count[data-ingredient-id="${ingredientId}"]`);
        if (countElement) {
            const quantity = this.selectedIngredients[ingredientId] ? this.selectedIngredients[ingredientId].quantity : 0;
            countElement.textContent = quantity;
        }
    }

    updateTotalAmount() {
        let total = 0;
        Object.values(this.selectedIngredients).forEach(ingredient => {
            total += ingredient.price * ingredient.quantity;
        });

        const totalElement = document.querySelector(this.selectors.totalAmount);
        if (totalElement) {
            totalElement.textContent = `${total.toFixed(2)} $`;
        }
    }

    resetIngredients() {
        this.selectedIngredients = {};


        document.querySelectorAll(this.selectors.ingredientCounts).forEach(element => {
            element.textContent = '0';
        });


        const totalElement = document.querySelector(this.selectors.totalAmount);
        if (totalElement) {
            totalElement.textContent = '0.00 $';
        }
    }

    addIngredientsToPizza() {
        if (this.currentPizzaId) {

            console.log('Ingredients for pizza', this.currentPizzaId, ':', this.selectedIngredients);
            this.closeIngredientsPopup();
            alert('Ingredients added to pizza!');
        }
    }

    async addToCart(orderButton) {
        try {
            console.log('addToCart method called');

            const card = orderButton.closest('[data-js-pizza-card]');
            if (!card) {
                console.error('Card element not found');
                return;
            }

            const pizzaId = card.dataset.pizzaId;
            console.log('Pizza ID:', pizzaId);

            if (!pizzaId) {
                console.error('Pizza ID not found in data-pizza-id attribute');
                return;
            }

            const pizzaName = card.querySelector('.pizza-menu__name-pizza')?.textContent;
            const description = card.querySelector('.pizza-menu__description')?.textContent;

            if (!pizzaName) {
                console.error('Pizza name not found');
                return;
            }

     
            const selectedSizeInput = card.querySelector(`${this.selectors.sizeCheckboxes}:checked`);
            if (!selectedSizeInput) {
                alert('Please select a pizza size first!');
                return;
            }

            const sizeId = selectedSizeInput.dataset.sizeId;
            const sizeName = selectedSizeInput.getAttribute('aria-label')?.replace('Pizza ', '');
            const price = selectedSizeInput.dataset.price;
            const quantity = card.querySelector('.pizza-menu__count')?.textContent || '1';

            console.log('Cart data:', {
                pizzaId, pizzaName, description, sizeId, sizeName, price, quantity
            });

         
            const extraIngredients = Object.entries(this.selectedIngredients).map(([id, data]) => ({
                id: parseInt(id),
                name: data.name,
                price: data.price,
                quantity: data.quantity
            }));

            console.log('Extra ingredients:', extraIngredients);

          
            const pizzaData = {
                pizzaId: parseInt(pizzaId),
                pizzaName,
                description,
                price: parseFloat(price),
                sizeId: parseInt(sizeId),
                sizeName,
                extraIngredients,
                quantity: parseInt(quantity)
            };

            console.log('Pizza data for cart:', pizzaData);

   
            if (!window.CartManager) {
                console.error('CartManager is not available');
                alert('Cart system is not available. Please refresh the page.');
                return;
            }

      
            const success = CartManager.addPizza(pizzaData);

            if (success) {
                console.log('Pizza successfully added to cart');

            
                alert(`Added ${quantity} ${pizzaName} to cart!`);

          
                this.resetPizzaCard(card);
            } else {
                alert('Failed to add to cart. Please try again.');
            }

        } catch (error) {
            console.error('Error in addToCart:', error);
            alert('An error occurred while adding to cart. Please try again.');
        }
    }

    resetPizzaCard(card) {

        const countElement = card.querySelector('.pizza-menu__count');
        if (countElement) {
            countElement.textContent = '1';
        }

        const sizeInputs = card.querySelectorAll(this.selectors.sizeCheckboxes);
        sizeInputs.forEach(input => {
            input.checked = false;
        });


        const priceElement = card.querySelector('.pizza-menu__price');
        if (priceElement && priceElement.dataset.basePrice) {
            const basePrice = parseFloat(priceElement.dataset.basePrice);
            priceElement.innerHTML = `${basePrice.toFixed(2)} <sup>$</sup>`;
        }

       
        this.selectedIngredients = {};
    }
}


document.addEventListener('DOMContentLoaded', () => {
    new PizzaMenu();
});