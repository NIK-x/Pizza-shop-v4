// export default class Header {
//     selectors = {
//         menuList: "[data-js-menu-list]",
//         menuLinks: "[data-js-menu-links]",
//         burgerButton: "[data-js-burger-button]",
//         favouritesButton: "[data-js-favourites-button]",
//         loginButton: "[data-js-login-button]",
//         popUp: "[data-js-popUp]"
//     }

//     constructor() {
//         this.popUp = document.querySelector(this.selectors.popUp);
//         this.menuList = document.querySelector(this.selectors.menuList);
//         this.menuLinks = this.menuList.querySelectors(this.selectors.menuLinks);
//         this.favouritesButton = document.querySelector(this.selectors.favouritesButton);
//         this.loginButton = document.querySelector(this.selectors.loginButton);
//         this.burgerButton = document.querySelector(this.selectors.burgerButton);
//     }

//     init() {
//         this.login();
//     }

//     login() {
//         this.loginButton.addEventListener("click", () => {
//             this.popUp.classList.remove("hidden");
//         })
//     }


    
    
    
// }

// new Header();