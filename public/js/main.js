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
                switch(buttonCategoryValue) {
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