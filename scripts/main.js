class Header {
    selectors = {
        burgerButton: "[data-js-burger-button]",
        loginButton: "[data-js-login-button]",
        popUp: "[data-js-popUp]",
        headerOverlay: "[data-js-header-overlay]",
        menuList: "[data-js-menu-list]",
        items: "[data-js-item]"
    }

    // states = {
    //     active: "is-active"
    // }

    constructor() {
        this.menuList = document.querySelector(this.selectors.menuList);
        this.headerOverlay = document.querySelector(this.selectors.headerOverlay);
        this.popUp = document.querySelector(this.selectors.popUp);
        this.loginButton = document.querySelector(this.selectors.loginButton);
        this.burgerButton = document.querySelector(this.selectors.burgerButton);
        this.items = document.querySelector(this.selectors.items);
        this.init();
    }

    init() {
        this.burgerMenu();
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
        });

        this.headerOverlay.addEventListener("click", () => {
            this.headerOverlay.classList.remove("is-active");
            this.menuList.classList.remove("is-active")
        })
    }
}

new Header().init();


class FilterPizza {
    selectors = {
        filterButtons: "[data-js-button-filter]",
        pizzaCard: "[data-js-pizza-card]",
        pizzaPopularBox: "[data-js-popular]",
    }

    states = {
        isHidden: "hidden",
        isShow: "show",
    }

    constructor() {
        this.pizzaCard = document.querySelectorAll(this.selectors.pizzaCard)
        this.filterButtons = document.querySelectorAll(this.selectors.filterButtons);
        this.pizzaPopularBox = document.querySelector(this.selectors.pizzaPopularBox);

        this.getFilterPizza();
    }

    showAll() {
        this.pizzaCard.forEach((pizza) => {
            if (pizza.classList.contains(this.states.isHidden)) {
                pizza.classList.remove(this.states.isHidden);
            }
        })
    }

    showFilterPizza(filterValue) {
        this.pizzaCard.forEach((pizza) => {
            const pizzaCategoryValue = pizza.dataset.category;
            
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
                if (buttonFilterValue == "all") {
                    this.showAll();
                } else {
                    
                    this.showFilterPizza(buttonFilterValue);
                }
            })

        })
    }

}
new FilterPizza();