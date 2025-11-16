class Order {
    selectors = {
        buttonAdd: "[data-js-button-add]",
        buttonReduce: "[data-js-button-reduce]",
        buttonBuy: "[data-js-button-place-an-order]",
        inputPromocode: "[data-js-input-promocode]",
        count: "[data-js-count]",
        pricePizzas: "[data-js-price]",
        result: "[data-js-result]",
        emptyPoster: "[data-js-empty]",
    }
    
    stats = {
        isHidden: "is-hidden",
        isShow: "is-show",
    }

    // promocodes = {
    //     one: "1",
    //     free: "FREE PIZZA",
    // }

    constructor() {
        this.buttonAdd = document.querySelector(this.selectors.buttonAdd);
        this.buttonReduce = document.querySelector(this.selectors.buttonReduce);
        this.buttonBuy = document.querySelector(this.selectors.buttonBuy);
        this.inputPromocode = document.querySelector(this.selectors.inputPromocode);
        this.count = document.querySelector(this.selectors.count);
        this.pricePizzas = document.querySelectorAll(this.selectors.pricePizzas);
        this.result = document.querySelector(this.selectors.result);

        this.currentCount = 1;
        this.basePrice = 0;
        this.finalPrice = 0;
        this.promocode = 1;
        this.init();
    }

    init() {
        this.changeTheNumber();
        this.updatePrice();
        // this.usePromocode();
        this.getPromocode();
   
    }

    changeTheNumber() {        
        this.buttonAdd.addEventListener("click", () => {
            this.currentCount += 1;
            this.count.textContent = this.currentCount
            this.updatePrice();
            
        });

        this.buttonReduce.addEventListener("click", () => {
            if (this.currentCount > 1) {
                this.currentCount -= 1;
                this.count.textContent = this.currentCount;
            }
        });
    }

    // usePromocode(resultCurrent) {
    //     this.inputPromocode.addEventListener("change", () => {                 
    //         if (this.inputPromocode.value === this.promocodes.one) {
    //             resultCurrent * 0,5;
    //             this.inputPromocode.value = "";
    //             this.inputPromocode.placeholder = "Успешно!";
                
    //         } else if (this.inputPromocode.value === this.promocodes.free) {
    //             resultCurrent = 1;
    //             this.inputPromocode.value = "";
    //             this.inputPromocode.placeholder = "Успешно!";
    //         } else {
    //             this.inputPromocode.value = "";
    //             this.inputPromocode.placeholder = "Промокод не найден";
    //         }
    //         this.updatePrice();
    //     });
        
    // }
    getPromocode() {
        this.inputPromocode.addEventListener("change", () => {
            let value = this.inputPromocode.value.trim();
            if (value == "50") {
                this.promocode = 0.5;
                this.inputPromocode.value = "";
                this.inputPromocode.placeholder = "Применён";
                this.updatePrice();
            } else {
                this.inputPromocode.value = "";
                this.inputPromocode.placeholder = "Ошибка";
            }
        });
    }
    
    culcPrice() {
        this.basePrice = 0;
        this.pricePizzas.forEach((element) => {
            let textElement = element.textContent.replace("$", "");
            this.basePrice += Number(textElement);
        })
        this.result.textContent = this.basePrice * this.promocode + "$";
    }

    updatePrice() {
        this.culcPrice();
    }


}

const order = new Order();
