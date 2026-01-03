<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <title>PizzaShop</title>
    {{-- <link rel="stylesheet" href="styles/main.css">
    <script src="scripts/main.js" defer></script> --}}
    @vite(['resources/scss/main.scss'])
</head>

<body>
    <header class="header header--sticky">
        <a href="{{ url('/') }}" class="header__logo">pizzashop</a>
        <div class="header__overlay" data-js-header-overlay> <!-- Desctop: hidden-mobile -->
            <nav class="header__nav-menu">
                <ul class="header__menu-list" data-js-menu-list>
                    <li class="header__menu-item item item-home" data-js-item><a href="{{ url('/') }}" class="header__menu-link">Home</a></li>
                    <li class="header__menu-item item item-menu" data-js-item><a href="#menu" class="header__menu-link">Menu</a>
                    </li>
                    <li class="header__menu-item item item-events" data-js-item><a href="#events" class="header__menu-link header__events"
                    >Events</a></li>
                    <li class="header__menu-item item item-about" data-js-item><a href="#about-us" class="header__menu-link">About
                    us</a></li>
                </ul>
            </nav>
        </div>
        <div class="header__box">
            <button type="button" class="header__button-login accent-button" data-js-login-button>Log in</button>
            <a href="{{ route('favourites') }}" class="header__button-favourites" aria-label="Add to Cart"
                title="Add to Cart"><img src="{{ asset('icons/favorites.svg') }}" alt="Add to Cart" loading="lazy" width="45"
                    height="45" class="header__icon-favorites"></a>
            <button type="button" class="burger-button visible-mobile" aria-label="View the site navigation"
                title="View the site navigation" data-js-burger-button>
                <span class="burger-button__line burger-button__line-1"></span>
                <span class="burger-button__line burger-button__line-2"></span>
                <span class="burger-button__line burger-button__line-3"></span>
            </button>
        </div>
    </header>
    <main class="main">
    @endphp
        <section class="hero" aria-labelledby="hero__title">
            <div class="hero__inner">
                <div class="hero__description-block">
                    <span class="hero__design-text-1 design-text">Pizza</span>
                    <span class="hero__design-text-2 design-text">Pizza</span>
                    <h1 class="hero__title">The Fastest<span class="hero__box">Pizza<img src="{{ asset('icons/Lightning.svg') }}"
                    loading="lazy" alt="" width="49" height="85" class="hero__icon">Delivery</span></h1>
                    <p class="hero__description">We will deliver juicy pizza for your family in 30 minutes, if the
                        courier is late - <span class="hero__highlighting">pizza is free!</span></p>
                </div>
                <div class="hero__coocking-box">
                    <div class="hero__coocking-block">
                        <p class="hero__description">Cooking process:</p>
                        <div class="hero__video">
                            <button type="button" class="hero__open-video" title="Watch a pizza cooking video"
                                aria-label="Watch a pizza cooking video"><img src="{{ asset('icons/open-video.svg') }}"
                                    class="hero__open-video-icon" loading="lazy" alt="Watch a pizza cooking video"
                                    width="81" height="81"></button>
                        </div>
                    </div>
                    <a href="#menu" class="hero__button">View the menu</a>
                    <span class="hero__design-text-3 design-text">Pizza</span>
                </div>
            </div>
            <img 
            srcset="{{ asset('images/hero-pizza.png') }} 1200w, {{ asset('images/pizza-poster-mobile.png') }} 600w"
            sizes="(min-width: 1200px) 1200px, 100vw"
            src="{{ asset('images/hero-pizza.png') }}"
            loading="lazy" 
            alt="Вкусная пицца" 
            class="hero__pizza-poster">
        </section>
       <section class="pizza-menu" aria-labelledby="pizza-menu__title">
    <div class="pizza-menu__block">
        <span class="pizza-menu__design-text-1 design-text">Menu</span>
        <h2 class="pizza-menu__title" id="menu">Menu</h2>
        <header class="pizza-menu__header">
            <button type="button" class="pizza-menu__button-show-all pizza-menu__button is-active" data-filter="all" data-js-button-filter>Show all</button>
            <button type="button" class="pizza-menu__button-meat pizza-menu__button" data-filter="meat" data-js-button-filter>Meat</button>
            <button type="button" class="pizza-menu__button-vegetarian pizza-menu__button" data-filter="vegetarian" data-js-button-filter>Vegetarian</button>
            <button type="button" class="pizza-menu__button-sea-products pizza-menu__button" data-filter="sea" data-js-button-filter>Sea products</button>
            <button type="button" class="pizza-menu__button-mushroom pizza-menu__button" data-filter="mushroom" data-js-button-filter>Mushroom</button>
        </header>
    </div>
    
    <div class="all-pizza" data-js-all-pizza>
        <!-- Обычные пиццы -->
        <div class="pizza-menu__cards all-cards" data-js-block-pizza>
            <!-- card1 Italian -->
            <article class="pizza-menu__card" data-category="meat" data-js-pizza-card data-pizza-id="1">
                <div class="pizza-menu__card-hero">
                    <img src="{{ asset('images/italian-pizza.png') }}" loading="lazy" alt="Italian Pizza" width="159" height="157" class="pizza-menu__image-pizza">
                    <h3 class="pizza-menu__name-pizza">Italian</h3>
                    <p class="pizza-menu__description">Filling: pepperoni, salami, mozzarella, tomato sauce, Italian herbs</p>
                </div>
                <div class="pizza-menu__block-checkbox">
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-italian" id="italian-small" class="pizza-menu__checkbox-smal pizza-menu__checkbox" aria-label="Pizza 22 cm" data-size-id="1" data-price="8.35" data-base-price="8.35">
                    </p>
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-italian" id="italian-normal" class="pizza-menu__checkbox-normal pizza-menu__checkbox" aria-label="Pizza 28 cm" data-size-id="2" data-price="10.35" data-base-price="8.35">
                    </p>
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-italian" id="italian-big" class="pizza-menu__checkbox-big pizza-menu__checkbox" aria-label="Pizza 33 cm" data-size-id="3" data-price="12.35" data-base-price="8.35">
                    </p>
                </div>
                <button type="button" class="pizza-menu__button-add-ingredients" data-pizza-id="1">
                    <span class="pizza-menu__text">+ Ingredients</span>
                </button>
                <div class="pizza-menu__box">
                    <p class="pizza-menu__price" data-base-price="8.35">8,35 <sup>$</sup></p>
                    <div class="pizza-menu__in-total">
                        <button type="button" class="pizza-menu__button-reduce-the-number" title="Reduce by one pizza" aria-label="Reduce by one pizza" data-action="decrease">
                            <img src="{{ asset('icons/remove-icon.svg') }}" alt="Reduce" loading="lazy" width="23" height="23">
                        </button>
                        <p class="pizza-menu__count">1</p>
                        <button type="button" class="pizza-menu__button-increase-the-number" aria-label="Add another pizza" title="Add another pizza" data-action="increase">
                            <img src="{{ asset('icons/add-icon.svg') }}" alt="Add" loading="lazy" width="23" height="23">
                        </button>
                    </div>
                </div>
                <button type="button" class="pizza-menu__add-to-favorites accent-button" data-pizza-id="1">Order Now</button>
            </article>
            
            <!-- card2 Venecia -->
            <article class="pizza-menu__card" data-category="sea" data-js-pizza-card data-pizza-id="2">
                <div class="pizza-menu__card-hero">
                    <img src="{{ asset('images/venecia-pizza.png') }}" loading="lazy" alt="Venecia Pizza" width="159" height="157" class="pizza-menu__image-pizza">
                    <h3 class="pizza-menu__name-pizza">Venecia</h3>
                    <p class="pizza-menu__description">Filling: shrimp, mussels, calamari, gorgonzola cheese, pesto sauce</p>
                </div>
                <div class="pizza-menu__block-checkbox">
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-venecia" id="venecia-small" class="pizza-menu__checkbox-smal pizza-menu__checkbox" aria-label="Pizza 22 cm" data-size-id="1" data-price="7.35" data-base-price="7.35">
                    </p>
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-venecia" id="venecia-normal" class="pizza-menu__checkbox-normal pizza-menu__checkbox" aria-label="Pizza 28 cm" data-size-id="2" data-price="9.35" data-base-price="7.35">
                    </p>
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-venecia" id="venecia-big" class="pizza-menu__checkbox-big pizza-menu__checkbox" aria-label="Pizza 33 cm" data-size-id="3" data-price="11.35" data-base-price="7.35">
                    </p>
                </div>
                <button type="button" class="pizza-menu__button-add-ingredients" data-pizza-id="2">
                    <span class="pizza-menu__text">+ Ingredients</span>
                </button>
                <div class="pizza-menu__box">
                    <p class="pizza-menu__price" data-base-price="7.35">7,35 <sup>$</sup></p>
                    <div class="pizza-menu__in-total">
                        <button type="button" class="pizza-menu__button-reduce-the-number" title="Reduce by one pizza" aria-label="Reduce by one pizza" data-action="decrease">
                            <img src="{{ asset('icons/remove-icon.svg') }}" alt="Reduce" loading="lazy" width="23" height="23">
                        </button>
                        <p class="pizza-menu__count">1</p>
                        <button type="button" class="pizza-menu__button-increase-the-number" aria-label="Add another pizza" title="Add another pizza" data-action="increase">
                            <img src="{{ asset('icons/add-icon.svg') }}" alt="Add" loading="lazy" width="23" height="23">
                        </button>
                    </div>
                </div>
                <button type="button" class="pizza-menu__add-to-favorites accent-button" data-pizza-id="2">Order Now</button>
            </article>
            
            <!-- card3 Meat -->
            <article class="pizza-menu__card" data-category="meat" data-js-pizza-card data-pizza-id="3">
                <div class="pizza-menu__card-hero">
                    <img src="{{ asset('images/meat-pizza.png') }}" loading="lazy" alt="Meat Pizza" width="159" height="157" class="pizza-menu__image-pizza">
                    <h3 class="pizza-menu__name-pizza">Meat</h3>
                    <p class="pizza-menu__description">Filling: bacon, ham, pepperoni, chicken, cheddar cheese, BBQ sauce</p>
                </div>
                <div class="pizza-menu__block-checkbox">
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-meat" id="meat-small" class="pizza-menu__checkbox-smal pizza-menu__checkbox" aria-label="Pizza 22 cm" data-size-id="1" data-price="9.35" data-base-price="9.35">
                    </p>
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-meat" id="meat-normal" class="pizza-menu__checkbox-normal pizza-menu__checkbox" aria-label="Pizza 28 cm" data-size-id="2" data-price="11.35" data-base-price="9.35">
                    </p>
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-meat" id="meat-big" class="pizza-menu__checkbox-big pizza-menu__checkbox" aria-label="Pizza 33 cm" data-size-id="3" data-price="13.35" data-base-price="9.35">
                    </p>
                </div>
                <button type="button" class="pizza-menu__button-add-ingredients" data-pizza-id="3">
                    <span class="pizza-menu__text">+ Ingredients</span>
                </button>
                <div class="pizza-menu__box">
                    <p class="pizza-menu__price" data-base-price="9.35">9,35 <sup>$</sup></p>
                    <div class="pizza-menu__in-total">
                        <button type="button" class="pizza-menu__button-reduce-the-number" title="Reduce by one pizza" aria-label="Reduce by one pizza" data-action="decrease">
                            <img src="{{ asset('icons/remove-icon.svg') }}" alt="Reduce" loading="lazy" width="23" height="23">
                        </button>
                        <p class="pizza-menu__count">1</p>
                        <button type="button" class="pizza-menu__button-increase-the-number" aria-label="Add another pizza" title="Add another pizza" data-action="increase">
                            <img src="{{ asset('icons/add-icon.svg') }}" alt="Add" loading="lazy" width="23" height="23">
                        </button>
                    </div>
                </div>
                <button type="button" class="pizza-menu__add-to-favorites accent-button" data-pizza-id="3">Order Now</button>
            </article>
            
            <!-- card4 Cheese -->
            <article class="pizza-menu__card" data-category="vegetarian" data-js-pizza-card data-pizza-id="4">
                <div class="pizza-menu__card-hero">
                    <img src="{{ asset('images/cheese-pizza.png') }}" loading="lazy" alt="Cheese Pizza" width="159" height="157" class="pizza-menu__image-pizza">
                    <h3 class="pizza-menu__name-pizza">Cheese</h3>
                    <p class="pizza-menu__description">Filling: 4-cheese blend: mozzarella, parmesan, gorgonzola, cheddar</p>
                </div>
                <div class="pizza-menu__block-checkbox">
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-cheese" id="cheese-small" class="pizza-menu__checkbox-smal pizza-menu__checkbox" aria-label="Pizza 22 cm" data-size-id="1" data-price="8.35" data-base-price="8.35">
                    </p>
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-cheese" id="cheese-normal" class="pizza-menu__checkbox-normal pizza-menu__checkbox" aria-label="Pizza 28 cm" data-size-id="2" data-price="10.35" data-base-price="8.35">
                    </p>
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-cheese" id="cheese-big" class="pizza-menu__checkbox-big pizza-menu__checkbox" aria-label="Pizza 33 cm" data-size-id="3" data-price="12.35" data-base-price="8.35">
                    </p>
                </div>
                <button type="button" class="pizza-menu__button-add-ingredients" data-pizza-id="4">
                    <span class="pizza-menu__text">+ Ingredients</span>
                </button>
                <div class="pizza-menu__box">
                    <p class="pizza-menu__price" data-base-price="8.35">8,35 <sup>$</sup></p>
                    <div class="pizza-menu__in-total">
                        <button type="button" class="pizza-menu__button-reduce-the-number" title="Reduce by one pizza" aria-label="Reduce by one pizza" data-action="decrease">
                            <img src="{{ asset('icons/remove-icon.svg') }}" alt="Reduce" loading="lazy" width="23" height="23">
                        </button>
                        <p class="pizza-menu__count">1</p>
                        <button type="button" class="pizza-menu__button-increase-the-number" aria-label="Add another pizza" title="Add another pizza" data-action="increase">
                            <img src="{{ asset('icons/add-icon.svg') }}" alt="Add" loading="lazy" width="23" height="23">
                        </button>
                    </div>
                </div>
                <button type="button" class="pizza-menu__add-to-favorites accent-button" data-pizza-id="4">Order Now</button>
            </article>
        </div>
        
        <!-- Популярные пиццы -->
        <article class="popular-block" data-js-popular>
            <span class="pizza-menu__design-text-2 design-text">Menu</span>
            <h3 class="popular-block__title">most popular pizza</h3>
        </article>
        
        <div class="pizza-menu__cards pizza-menu__popular-cards all-cards" data-js-block-pizza>
            <!-- card5 Argentina -->
            <article class="pizza-menu__card" data-category="meat" data-js-pizza-card data-pizza-id="5">
                <span class="pizza-menu__design-text-3 design-text">Menu</span>
                <div class="pizza-menu__card-hero">
                    <img src="{{ asset('images/argentina-pizza.png') }}" loading="lazy" alt="Argentina Pizza" width="159" height="157" class="pizza-menu__image-pizza">
                    <h3 class="pizza-menu__name-pizza">Argentina</h3>
                    <p class="pizza-menu__description">Filling: grilled beef, jalapeño peppers, corn, tomato sauce</p>
                </div>
                <div class="pizza-menu__block-checkbox">
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-argentina" id="argentina-small" class="pizza-menu__checkbox-smal pizza-menu__checkbox" aria-label="Pizza 22 cm" data-size-id="1" data-price="7.35" data-base-price="7.35">
                    </p>
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-argentina" id="argentina-normal" class="pizza-menu__checkbox-normal pizza-menu__checkbox" aria-label="Pizza 28 cm" data-size-id="2" data-price="9.35" data-base-price="7.35">
                    </p>
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-argentina" id="argentina-big" class="pizza-menu__checkbox-big pizza-menu__checkbox" aria-label="Pizza 33 cm" data-size-id="3" data-price="11.35" data-base-price="7.35">
                    </p>
                </div>
                <button type="button" class="pizza-menu__button-add-ingredients" data-pizza-id="5">
                    <span class="pizza-menu__text">+ Ingredients</span>
                </button>
                <div class="pizza-menu__box">
                    <p class="pizza-menu__price" data-base-price="7.35">7,35 <sup>$</sup></p>
                    <div class="pizza-menu__in-total">
                        <button type="button" class="pizza-menu__button-reduce-the-number" title="Reduce by one pizza" aria-label="Reduce by one pizza" data-action="decrease">
                            <img src="{{ asset('icons/remove-icon.svg') }}" alt="Reduce" loading="lazy" width="23" height="23">
                        </button>
                        <p class="pizza-menu__count">1</p>
                        <button type="button" class="pizza-menu__button-increase-the-number" aria-label="Add another pizza" title="Add another pizza" data-action="increase">
                            <img src="{{ asset('icons/add-icon.svg') }}" alt="Add" loading="lazy" width="23" height="23">
                        </button>
                    </div>
                </div>
                <button type="button" class="pizza-menu__add-to-favorites accent-button" data-pizza-id="5">Order Now</button>
            </article>
            
            <!-- card6 Gribnaya -->
            <article class="pizza-menu__card" data-category="mushroom" data-js-pizza-card data-pizza-id="6">
                <div class="pizza-menu__card-hero">
                    <img src="{{ asset('images/gribnaya-pizza.png') }}" loading="lazy" alt="Gribnaya Pizza" width="159" height="157" class="pizza-menu__image-pizza">
                    <h3 class="pizza-menu__name-pizza">Gribnaya</h3>
                    <p class="pizza-menu__description">Filling: champignon, oyster mushrooms, mozzarella, cream sauce, dill</p>
                </div>
                <div class="pizza-menu__block-checkbox">
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-gribnaya" id="gribnaya-small" class="pizza-menu__checkbox-smal pizza-menu__checkbox" aria-label="Pizza 22 cm" data-size-id="1" data-price="6.35" data-base-price="6.35">
                    </p>
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-gribnaya" id="gribnaya-normal" class="pizza-menu__checkbox-normal pizza-menu__checkbox" aria-label="Pizza 28 cm" data-size-id="2" data-price="8.35" data-base-price="6.35">
                    </p>
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-gribnaya" id="gribnaya-big" class="pizza-menu__checkbox-big pizza-menu__checkbox" aria-label="Pizza 33 cm" data-size-id="3" data-price="10.35" data-base-price="6.35">
                    </p>
                </div>
                <button type="button" class="pizza-menu__button-add-ingredients" data-pizza-id="6">
                    <span class="pizza-menu__text">+ Ingredients</span>
                </button>
                <div class="pizza-menu__box">
                    <p class="pizza-menu__price" data-base-price="6.35">6,35 <sup>$</sup></p>
                    <div class="pizza-menu__in-total">
                        <button type="button" class="pizza-menu__button-reduce-the-number" title="Reduce by one pizza" aria-label="Reduce by one pizza" data-action="decrease">
                            <img src="{{ asset('icons/remove-icon.svg') }}" alt="Reduce" loading="lazy" width="23" height="23">
                        </button>
                        <p class="pizza-menu__count">1</p>
                        <button type="button" class="pizza-menu__button-increase-the-number" aria-label="Add another pizza" title="Add another pizza" data-action="increase">
                            <img src="{{ asset('icons/add-icon.svg') }}" alt="Add" loading="lazy" width="23" height="23">
                        </button>
                    </div>
                </div>
                <button type="button" class="pizza-menu__add-to-favorites accent-button" data-pizza-id="6">Order Now</button>
            </article>
            
            <!-- card7 Tomato -->
            <article class="pizza-menu__card" data-category="vegetarian" data-js-pizza-card data-pizza-id="7">
                <div class="pizza-menu__card-hero">
                    <img src="{{ asset('images/tomato-pizza.png') }}" loading="lazy" alt="Tomato Pizza" width="159" height="157" class="pizza-menu__image-pizza">
                    <h3 class="pizza-menu__name-pizza">Tomato</h3>
                    <p class="pizza-menu__description">Filling: sun-dried tomatoes, fresh tomatoes, basil, mozzarella, olive oil</p>
                </div>
                <div class="pizza-menu__block-checkbox">
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-tomato" id="tomato-small" class="pizza-menu__checkbox-smal pizza-menu__checkbox" aria-label="Pizza 22 cm" data-size-id="1" data-price="7.35" data-base-price="7.35">
                    </p>
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-tomato" id="tomato-normal" class="pizza-menu__checkbox-normal pizza-menu__checkbox" aria-label="Pizza 28 cm" data-size-id="2" data-price="9.35" data-base-price="7.35">
                    </p>
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-tomato" id="tomato-big" class="pizza-menu__checkbox-big pizza-menu__checkbox" aria-label="Pizza 33 cm" data-size-id="3" data-price="11.35" data-base-price="7.35">
                    </p>
                </div>
                <button type="button" class="pizza-menu__button-add-ingredients" data-pizza-id="7">
                    <span class="pizza-menu__text">+ Ingredients</span>
                </button>
                <div class="pizza-menu__box">
                    <p class="pizza-menu__price" data-base-price="7.35">7,35 <sup>$</sup></p>
                    <div class="pizza-menu__in-total">
                        <button type="button" class="pizza-menu__button-reduce-the-number" title="Reduce by one pizza" aria-label="Reduce by one pizza" data-action="decrease">
                            <img src="{{ asset('icons/remove-icon.svg') }}" alt="Reduce" loading="lazy" width="23" height="23">
                        </button>
                        <p class="pizza-menu__count">1</p>
                        <button type="button" class="pizza-menu__button-increase-the-number" aria-label="Add another pizza" title="Add another pizza" data-action="increase">
                            <img src="{{ asset('icons/add-icon.svg') }}" alt="Add" loading="lazy" width="23" height="23">
                        </button>
                    </div>
                </div>
                <button type="button" class="pizza-menu__add-to-favorites accent-button" data-pizza-id="7">Order Now</button>
            </article>
            
            <!-- card8 Italian x2 -->
            <article class="pizza-menu__card" data-category="meat mushroom" data-js-pizza-card data-pizza-id="8">
                <div class="pizza-menu__card-hero">
                    <img src="{{ asset('images/italian-x2-pizza.png') }}" loading="lazy" alt="Italian x2 Pizza" width="159" height="157" class="pizza-menu__image-pizza">
                    <h3 class="pizza-menu__name-pizza">Italian x2</h3>
                    <p class="pizza-menu__description">Filling: Salami, portobello mushrooms, olives, cheese, tomato sauce</p>
                </div>
                <div class="pizza-menu__block-checkbox">
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-italian-two" id="italian-two-small" class="pizza-menu__checkbox-smal pizza-menu__checkbox" aria-label="Pizza 22 cm" data-size-id="1" data-price="8.35" data-base-price="8.35">
                    </p>
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-italian-two" id="italian-two-normal" class="pizza-menu__checkbox-normal pizza-menu__checkbox" aria-label="Pizza 28 cm" data-size-id="2" data-price="10.35" data-base-price="8.35">
                    </p>
                    <p class="pizza-menu__field">
                        <input type="radio" name="size-italian-two" id="italian-two-big" class="pizza-menu__checkbox-big pizza-menu__checkbox" aria-label="Pizza 33 cm" data-size-id="3" data-price="12.35" data-base-price="8.35">
                    </p>
                </div>
                <button type="button" class="pizza-menu__button-add-ingredients" data-pizza-id="8">
                    <span class="pizza-menu__text">+ Ingredients</span>
                </button>
                <div class="pizza-menu__box">
                    <p class="pizza-menu__price" data-base-price="8.35">8,35 <sup>$</sup></p>
                    <div class="pizza-menu__in-total">
                        <button type="button" class="pizza-menu__button-reduce-the-number" title="Reduce by one pizza" aria-label="Reduce by one pizza" data-action="decrease">
                            <img src="{{ asset('icons/remove-icon.svg') }}" alt="Reduce" loading="lazy" width="23" height="23">
                        </button>
                        <p class="pizza-menu__count">1</p>
                        <button type="button" class="pizza-menu__button-increase-the-number" aria-label="Add another pizza" title="Add another pizza" data-action="increase">
                            <img src="{{ asset('icons/add-icon.svg') }}" alt="Add" loading="lazy" width="23" height="23">
                        </button>
                    </div>
                </div>
                <button type="button" class="pizza-menu__add-to-favorites accent-button" data-pizza-id="8">Order Now</button>
            </article>
        </div>
    </div>
    
    <!-- Попап дополнительных ингредиентов -->
    <div class="wrapper-ingr hidden" data-js-ingredients-popup>
        <div class="ingredients-popUp">
            <button type="button" class="ingredients-popUp__close" aria-label="Close ingredients popup" data-js-close-ingredients>
                <img src="{{ asset('icons/close.svg') }}" alt="Close" width="24" height="24">
            </button>
            <h3 class="ingredients-popUp__title">Additional ingredients</h3>
            <div class="ingredients-popUp__wrapper">
                <div class="ingredients-popUp__box">
                    <button type="button" class="ingredients-popUp__button-add" title="Add sausage" aria-label="Add sausage" data-name="sausage" data-price="2" data-ingredient-id="1">
                        <img src="{{ asset('images/kolbasa.webp') }}" alt="Sausage" loading="lazy" width="100" height="100">
                        <span class="ingredients-popUp__ingredient-name">Sausage</span>
                    </button>
                    <div class="ingredients-popUp__counter">
                        <button type="button" class="ingredients-popUp__button-remove" data-ingredient-id="1">-</button>
                        <output class="ingredients-popUp__count" data-ingredient-id="1">0</output>
                        <button type="button" class="ingredients-popUp__button-add-count" data-ingredient-id="1">+</button>
                    </div>
                    <div class="ingredients-popUp__price">2 $</div>
                </div>
                <div class="ingredients-popUp__box">
                    <button type="button" class="ingredients-popUp__button-add" title="Add ham" aria-label="Add ham" data-name="ham" data-price="3" data-ingredient-id="2">
                        <img src="{{ asset('images/vetchina.webp') }}" alt="Ham" loading="lazy" width="100" height="100">
                        <span class="ingredients-popUp__ingredient-name">Ham</span>
                    </button>
                    <div class="ingredients-popUp__counter">
                        <button type="button" class="ingredients-popUp__button-remove" data-ingredient-id="2">-</button>
                        <output class="ingredients-popUp__count" data-ingredient-id="2">0</output>
                        <button type="button" class="ingredients-popUp__button-add-count" data-ingredient-id="2">+</button>
                    </div>
                    <div class="ingredients-popUp__price">3 $</div>
                </div>
                <div class="ingredients-popUp__box">
                    <button type="button" class="ingredients-popUp__button-add" title="Add mozzarella" aria-label="Add mozzarella" data-name="mozzarella" data-price="12" data-ingredient-id="3">
                        <img src="{{ asset('images/mozarella.webp') }}" alt="Mozzarella" loading="lazy" width="100" height="100">
                        <span class="ingredients-popUp__ingredient-name">Mozzarella</span>
                    </button>
                    <div class="ingredients-popUp__counter">
                        <button type="button" class="ingredients-popUp__button-remove" data-ingredient-id="3">-</button>
                        <output class="ingredients-popUp__count" data-ingredient-id="3">0</output>
                        <button type="button" class="ingredients-popUp__button-add-count" data-ingredient-id="3">+</button>
                    </div>
                    <div class="ingredients-popUp__price">12 $</div>
                </div>
                <div class="ingredients-popUp__box">
                    <button type="button" class="ingredients-popUp__button-add" title="Add mushrooms" aria-label="Add mushrooms" data-name="mushrooms" data-price="4" data-ingredient-id="4">
                        <img src="{{ asset('images/gribi.webp') }}" alt="Mushrooms" loading="lazy" width="100" height="100">
                        <span class="ingredients-popUp__ingredient-name">Mushrooms</span>
                    </button>
                    <div class="ingredients-popUp__counter">
                        <button type="button" class="ingredients-popUp__button-remove" data-ingredient-id="4">-</button>
                        <output class="ingredients-popUp__count" data-ingredient-id="4">0</output>
                        <button type="button" class="ingredients-popUp__button-add-count" data-ingredient-id="4">+</button>
                    </div>
                    <div class="ingredients-popUp__price">4 $</div>
                </div>
                <div class="ingredients-popUp__box">
                    <button type="button" class="ingredients-popUp__button-add" title="Add pepper" aria-label="Add pepper" data-name="pepper" data-price="2" data-ingredient-id="5">
                        <img src="{{ asset('images/halapen.webp') }}" alt="Pepper" loading="lazy" width="100" height="100">
                        <span class="ingredients-popUp__ingredient-name">Pepper</span>
                    </button>
                    <div class="ingredients-popUp__counter">
                        <button type="button" class="ingredients-popUp__button-remove" data-ingredient-id="5">-</button>
                        <output class="ingredients-popUp__count" data-ingredient-id="5">0</output>
                        <button type="button" class="ingredients-popUp__button-add-count" data-ingredient-id="5">+</button>
                    </div>
                    <div class="ingredients-popUp__price">2 $</div>
                </div>
                <div class="ingredients-popUp__box">
                    <button type="button" class="ingredients-popUp__button-add" title="Add onion" aria-label="Add onion" data-name="onion" data-price="1" data-ingredient-id="6">
                        <img src="{{ asset('images/lok.webp') }}" alt="Onion" loading="lazy" width="100" height="100">
                        <span class="ingredients-popUp__ingredient-name">Onion</span>
                    </button>
                    <div class="ingredients-popUp__counter">
                        <button type="button" class="ingredients-popUp__button-remove" data-ingredient-id="6">-</button>
                        <output class="ingredients-popUp__count" data-ingredient-id="6">0</output>
                        <button type="button" class="ingredients-popUp__button-add-count" data-ingredient-id="6">+</button>
                    </div>
                    <div class="ingredients-popUp__price">1 $</div>
                </div>
            </div>
            <div class="ingredients-popUp__total">
                <output class="ingredients-popUp__total-price">
                    <span style="font-weight: 500;">Total amount:</span> 
                    <span class="ingredients-popUp__total-amount">0.00 $</span>
                </output>
                <button type="button" class="ingredients-popUp__button-order pizza-menu__add-to-favorites accent-button">Add to Order</button>
            </div>
        </div>  
    </div>
</section>
        <section class="events" aria-labelledby="events__main-title">
            <span class="events__design-text design-text">Events</span>
            <div class="events__first-box events__box">
                <article class="events__how-coockig-container events__event">
                    <h3 class="events__title">How we<br>coocking</h3>
                    <button type="button" class="events__button-more accent-button" data-js-more-buttons data-category="coocking">More</button>
                </article>
                <article class="events__our-blog-container events__event">
                    <h3 class="events__title">Our blog</h3>
                    <button type="button" class="events__button-more accent-button" data-js-more-buttons data-category="our-blog">More</button>
                </article>
                <div class="events__hero">
                    <h2 class="events__main-title" id="events">Events</h2>
                    <p class="events__description">There are regular events in our pizzeria that will allow you to eat
                    delicious food for a lower price!</p>
                </div>
            </div>
            <div class="events__second-box events__box">
                <article class="events__two-pizza-container events__event">
                    <h3 class="events__title">two pizza<br>for 1 price</h3>
                    <button type="button" class="events__button-more accent-button" data-js-more-buttons data-category="two-pizza">More</button>
                </article>
                <article class="events__kitchen-tour-container events__event">
                    <h3 class="events__title">Kitchen<br>tour</h3>
                    <button type="button" class="events__button-more accent-button" data-js-more-buttons data-category="kitchen-tour">More</button>
                </article>
            </div>
            <div class="events__third-box events__box">
                <article class="events__free-coffe-container events__event">
                    <h3 class="events__title">Free coffe<br>for 3 pizza</h3>
                    <button type="button" class="events__button-more accent-button" data-js-more-buttons data-category="free-coffe">More</button>
                </article>
                <article class="events__our-instagram-container events__event">
                    <h3 class="events__title">our<br>instagram</h3>
                    <button type="button" class="events__button-more accent-button" data-js-more-buttons data-category="instagram">More</button>
                </article>
                <article class="events__choose-container events__event">
                    <h3 class="events__title">Where are<br>you choose<br>us?</h3>
                    <button type="button" class="events__button-more accent-button" data-js-more-buttons data-category="choose-us">More</button>
                </article>
            </div>
            <div class="wrapper hidden" data-js-more-popUp>
                <div class="more-popUp">
                    <h2 class="more-popUp__title" data-js-title>Free Pizza</h2>
                    <p class="more-popUp__description" data-js-description>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi reprehenderit maxime nesciunt corporis totam maiores, ducimus necessitatibus hic. Minus, est!</p>
                </div>
            </div>
        </section>
        <section class="about-us" aria-labelledby="about-us__title">
            <div class="about-us__container">
                <span class="about-us__design-text-1 design-text">About</span>
                <h2 class="about-us__title" id="about-us">About us</h2>
                <div class="about-us__inner">
                    <p class="about-us__description">In just a couple of years, we have opened 6 outlets in different
                        cities: Kazan, Chelyabinsk, Ufa, Samara, Izhevsk, and in the future we plan to develop the
                        network in other major cities of Russia.</p>
                    <img src="{{ asset('images/pizzas.png') }}" alt="" loading="lazy" width="490" height="189"
                        class="about-us__pizzas">
                </div>
                <p class="about-us__description">The kitchen of each point is at least: 400-500 sq. m. meters, hundreds
                    of employees, smoothly performing work in order to receive / prepare / form / deliver customer
                    orders on time.</p>
            </div>
            <img src="{{ asset('icons/vector.svg') }}" loading="lazy" alt="" aria-hidden="true" class="about-us__vector" width="88"
                height="55">
            <img src="{{ asset('images/about-pizza-poster.png') }}" alt="" loading="lazy" width="812" height="783"
                class="about-us__pizza-poster">
            <span class="about-us__design-text-2 design-text">About</span>
        </section>
    </main>
    <footer class="footer">
        <div class="footer__navigation">
            <a href="{{ url('/') }}" class="footer__logo">pizzashop</a>
            <div class="footer__links-block">
                <div class="footer__inner">
                    <a href="#" class="footer__main-title">Home</a>
                    <ul class="footer__home-list footer__list">
                        <li class="footer__home-list__item"><a href="#menu" class="footer__home-list-link footer__link">To Order</a></li>
                        <li class="footer__home-list__item"><a href="#about-us" class="footer__home-list-link footer__link">About us</a></li>
                        <li class="footer__home-list__item"><a href="#events" class="footer__home-list-link footer__link">Events</a></li>
                    </ul>
                </div>
                <div class="footer__inner">
                    <a href="#menu" class="footer__main-title">Menu</a>   
                    <ul class="footer__menu-list footer__list">
                        <li class="footer__menu-list-item"><a href="#menu" class="footer__menu-list-link footer__link long">3 Pizza 1 Free Coffee</a></li>
                        <li class="footer__menu-list-item"><a href="#menu" class="footer__menu-list-link footer__link long">2 Pizza for 1 Price</a></li>
                        <li class="footer__menu-list-item"><a href="#menu" class="footer__menu-list-link footer__link long">Kitchen Tour</a></li>
                    </ul>
                </div>
                <div class="footer__inner">
                    <a href="#events" class="footer__main-title">Events</a> 
                    <ul class="footer__events-list footer__list">
                        <li class="footer__events-list-item"><a href="#events" class="footer__events-link footer__link">Show All</a></li>
                        <li class="footer__events-list-item"><a href="#events" class="footer__events-link footer__link">Seaproducts</a></li>
                        <li class="footer__events-list-item"><a href="#events" class="footer__events-link footer__link">Vegan</a></li>
                        <li class="footer__events-list-item"><a href="#events" class="footer__events-link footer__link">Meat</a></li>
                    </ul>   
                </div>
                <div class="footer__inner">
                   <a href="#about-us" class="footer__main-title">About us</a> 
                    <ul class="footer__about-us-list footer__list">
                        <li class="footer__about-us-list-item"><a href="#about-us" class="footer__about-us-list-link footer__link">Our History</a></li>
                        <li class="footer__about-us-list-item"><a href="#about-us" class="footer__about-us-list-link footer__link">Why We?</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer__connection">
            <a href="tel:+79373335533" class="footer__phone">+7 (937) 333-55-33</a>
            <div class="footer__popular-messengers">
                <a href="{{ url('/') }}" class="footer__button-messenger" title="go to instagram" aria-label="go to instagram"><img
                        src="{{ asset('icons/instagram.svg') }}" alt="instagram" loading="lazy" width="30" height="30"></a>
                <a href="{{ url('/') }}" class="footer__link-messenger" title="go to twitter" aria-label="go to twitter"><img
                        src="{{ asset('icons/twiter.svg') }}" alt="twitter" loading="lazy" width="30" height="30"></a>
                <a href="{{ url('/') }}" class="footer__link-messenger" title="go to facebook" aria-label="go to facebook"><img
                        src="{{ asset('icons/facebook.svg') }}" alt="facebook" loading="lazy" width="30" height="30"></a>
            </div>
        </div>
    </footer>
    <div class="backdrop hidden" data-js-backdrop>
        <div class="block-popup hidden" data-js-popUp>
            <div class="container">
                <button type="button" class="container__button-close" aria-label="Close the registration and login window"
                    title="Close the registration and login window" data-js-close-button><img src="{{ asset('icons/close.svg') }}" alt=""
                        loading="lazy" class="container__close"></button>
                <input type="checkbox" id="flip">
                <div class="cover">
                    <div class="front">
                        <img src="{{ asset('images\pizza-poster-login.jpg') }}" alt="">
                    </div>
                    <div class="back">
                        <img class="backImg" src="{{ asset('images/pizza-poster-login2.png') }}" alt="">
                    </div>
                </div>
                <div class="forms">
                    <div class="form-content">
                        <div class="login-form">
                            <h2 class="title">Login</h2>
                            <form action="#">
                                <div class="input-boxes">
                                    <div class="input-box">
                                        <i class="fas fa-envelope"></i>
                                        <input type="text" placeholder="Enter your email" required>
                                    </div>
                                    <div class="input-box">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" placeholder="Enter your password" required>
                                    </div>
                                    <div class="text"><a href="{{ url('/') }}">Forgot password?</a></div>
                                    <div class="button input-box">
                                        <input type="submit" value="Sumbit">
                                    </div>
                                    <div class="text sign-up-text">Don't have an account? <label for="flip">Sing up
                                            now</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="signup-form">
                            <div class="title">Sign up</div>
                            <form action="#">
                                <div class="input-boxes">
                                    <div class="input-box">
                                        <i class="fas fa-user"></i>
                                        <input type="text" placeholder="Enter your name" required>
                                    </div>
                                    <div class="input-box">
                                        <i class="fas fa-envelope"></i>
                                        <input type="text" placeholder="Enter your email" required>
                                    </div>
                                    <div class="input-box">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" placeholder="Enter your password" required>
                                    </div>
                                    <div class="button input-box">
                                        <input type="submit" value="Sumbit">
                                    </div>
                                    <div class="text sign-up-text">Already have an account? <label for="flip">Login
                                            now</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @vite(['resources/js/main.js'])
</body>

</html>