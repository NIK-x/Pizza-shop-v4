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



