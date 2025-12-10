

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