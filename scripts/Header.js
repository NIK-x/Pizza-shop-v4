export default class Header {
    selectors = {
        menuList: "[data-js-menu-list]",
        menuLinks: "[data-js-menu-links]",
        burgerButton: "[data-js-burger-button]",
        favouritesButton: "[data-js-favourites-button]",
        loginButton: "[data-js-login-button]",
    }

    constructor() {
        this.menuList = document.querySelector(this.selectors.menuList);
        this.menuLinks = this.menuList.querySelectors(this.selectors.menuLinks);
        this.favouritesButton = document.querySelector(this.selectors.favouritesButton);
        this.loginButton = document.querySelector(this.selectors.loginButton);
        this.burgerButton = document.querySelector(this.selectors.burgerButton);
    }

    
    
}

new Header();