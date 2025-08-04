<?php /* Template Name: Store Page */ ?>
<?php get_header(); ?>

<main>
    <section class="store-hero">
        <div class="store-hero__overlay"></div>
        <div class="container">
            <div class="store-hero__content">
                <!-- <p class="store-hero__breadcrumbs">Головна сторінка — Магазин</p> -->
                <h1 class="store-hero__title">Наша продукція</h1>
            </div>
        </div>
    </section>

    <section class="store-catalog">
        <div class="container">
            <div class="store-filters">
                <button class="filter-toggle">
                    <span>Обрати категорію</span>
                    <svg class="filter-toggle__arrow" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div class="filter-list">
                    <button class="filter-btn active" data-filter="all">Показати всі</button>
                    <button class="filter-btn" data-filter="motanky-xl">Великі мотанки (40 <span>см</span>)</button>
                    <button class="filter-btn" data-filter="motanky">Мотанки (30 <span>см</span>)</button>
                    <button class="filter-btn" data-filter="motanochka">Мотаночки (20 <span>см</span>)</button>
                    <button class="filter-btn" data-filter="zernianky">Зернянки (12 <span>см</span>)</button>
                    <button class="filter-btn" data-filter="accessories">Аксесуари</button>
                    <button class="filter-btn" data-filter="other">Інші</button>
                </div>
            </div>

            <div class="product-grid">
                <div class="product-card" data-category="motanky">
                    <a href="#" class="product-card__link">
                        <div class="product-card__image-wrap">
                            <img src="images/collection-1.webp" alt="Мотанка Продукт" class="product-card__image">
                            <div class="product-card__hover-overlay">
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__title">Мотанка Продукт</h3>
                            <p class="product-card__price">3999 грн</p>
                        </div>
                    </a>
                </div>
                <div class="product-card" data-category="motanky">
                    <a href="#" class="product-card__link">
                        <div class="product-card__image-wrap">
                            <img src="images/collection-1.webp" alt="Мотанка Продукт" class="product-card__image">
                                <div class="product-card__hover-overlay">
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__title">Мотанка Продукт</h3>
                            <p class="product-card__price">3999 грн</p>
                        </div>
                    </a>
                </div>
                <div class="product-card" data-category="motanochka">
                    <a href="#" class="product-card__link">
                        <div class="product-card__image-wrap">
                            <img src="images/collection-1.webp" alt="Мотанка Продукт" class="product-card__image">
                                <div class="product-card__hover-overlay">
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__title">Мотанка Продукт</h3>
                            <p class="product-card__price">3999 грн</p>
                        </div>
                    </a>
                </div>
                <div class="product-card" data-category="motanky">
                    <a href="#" class="product-card__link">
                        <div class="product-card__image-wrap">
                            <img src="images/collection-1.webp" alt="Мотанка Продукт" class="product-card__image">
                                <div class="product-card__hover-overlay">
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__title">Мотанка Продукт</h3>
                            <p class="product-card__price">3999 грн</p>
                        </div>
                    </a>
                </div>
                <div class="product-card" data-category="zernianky">
                    <a href="#" class="product-card__link">
                        <div class="product-card__image-wrap">
                            <img src="images/collection-1.webp" alt="Мотанка Продукт" class="product-card__image">
                                <div class="product-card__hover-overlay">
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__title">Мотанка Продукт</h3>
                            <p class="product-card__price">2499 грн</p>
                        </div>
                    </a>
                </div>
                <div class="product-card" data-category="motanky-xl">
                    <a href="#" class="product-card__link">
                        <div class="product-card__image-wrap">
                            <img src="images/collection-1.webp" alt="Мотанка Продукт" class="product-card__image">
                                <div class="product-card__hover-overlay">
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__title">Мотанка Продукт</h3>
                            <p class="product-card__price">4999 грн</p>
                        </div>
                    </a>
                </div>
                <div class="product-card" data-category="accessories">
                    <a href="#" class="product-card__link">
                        <div class="product-card__image-wrap">
                            <img src="images/collection-1.webp" alt="Мотанка Продукт" class="product-card__image">
                                <div class="product-card__hover-overlay">
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__title">Мотанка Продукт</h3>
                            <p class="product-card__price">1499 грн</p>
                        </div>
                    </a>
                </div>
                <div class="product-card" data-category="other">
                    <a href="#" class="product-card__link">
                        <div class="product-card__image-wrap">
                            <img src="images/collection-1.webp" alt="Мотанка Продукт" class="product-card__image">
                                <div class="product-card__hover-overlay">
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__title">Мотанка Продукт</h3>
                            <p class="product-card__price">799 грн</p>
                        </div>
                    </a>
                </div>
                    <div class="product-card" data-category="motanky">
                    <a href="#" class="product-card__link">
                        <div class="product-card__image-wrap">
                            <img src="images/collection-1.webp" alt="Мотанка Продукт" class="product-card__image">
                                <div class="product-card__hover-overlay">
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__title">Мотанка Продукт</h3>
                            <p class="product-card__price">3499 грн</p>
                        </div>
                    </a>
                </div>
                    <div class="product-card" data-category="motanochka">
                    <a href="#" class="product-card__link">
                        <div class="product-card__image-wrap">
                            <img src="images/collection-1.webp" alt="Мотанка Продукт" class="product-card__image">
                                <div class="product-card__hover-overlay">
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__title">Мотанка Продукт</h3>
                            <p class="product-card__price">1999 грн</p>
                        </div>
                    </a>
                </div>
                <div class="product-card" data-category="motanky">
                    <a href="#" class="product-card__link">
                        <div class="product-card__image-wrap">
                            <img src="images/collection-1.webp" alt="Мотанка Продукт" class="product-card__image">
                            <div class="product-card__hover-overlay">
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__title">Мотанка Продукт</h3>
                            <p class="product-card__price">3999 грн</p>
                        </div>
                    </a>
                </div>
                <div class="product-card" data-category="motanky">
                    <a href="#" class="product-card__link">
                        <div class="product-card__image-wrap">
                            <img src="images/collection-1.webp" alt="Мотанка Продукт" class="product-card__image">
                                <div class="product-card__hover-overlay">
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__title">Мотанка Продукт</h3>
                            <p class="product-card__price">3999 грн</p>
                        </div>
                    </a>
                </div>
                <div class="product-card" data-category="motanochka">
                    <a href="#" class="product-card__link">
                        <div class="product-card__image-wrap">
                            <img src="images/collection-1.webp" alt="Мотанка Продукт" class="product-card__image">
                                <div class="product-card__hover-overlay">
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__title">Мотанка Продукт</h3>
                            <p class="product-card__price">3999 грн</p>
                        </div>
                    </a>
                </div>
                <div class="product-card" data-category="motanky">
                    <a href="#" class="product-card__link">
                        <div class="product-card__image-wrap">
                            <img src="images/collection-1.webp" alt="Мотанка Продукт" class="product-card__image">
                                <div class="product-card__hover-overlay">
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__title">Мотанка Продукт</h3>
                            <p class="product-card__price">3999 грн</p>
                        </div>
                    </a>
                </div>
                <div class="product-card" data-category="zernianky">
                    <a href="#" class="product-card__link">
                        <div class="product-card__image-wrap">
                            <img src="images/collection-1.webp" alt="Мотанка Продукт" class="product-card__image">
                                <div class="product-card__hover-overlay">
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__title">Мотанка Продукт</h3>
                            <p class="product-card__price">2499 грн</p>
                        </div>
                    </a>
                </div>
                <div class="product-card" data-category="motanky-xl">
                    <a href="#" class="product-card__link">
                        <div class="product-card__image-wrap">
                            <img src="images/collection-1.webp" alt="Мотанка Продукт" class="product-card__image">
                                <div class="product-card__hover-overlay">
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__title">Мотанка Продукт</h3>
                            <p class="product-card__price">4999 грн</p>
                        </div>
                    </a>
                </div>
                <div class="product-card" data-category="accessories">
                    <a href="#" class="product-card__link">
                        <div class="product-card__image-wrap">
                            <img src="images/collection-1.webp" alt="Мотанка Продукт" class="product-card__image">
                                <div class="product-card__hover-overlay">
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__title">Мотанка Продукт</h3>
                            <p class="product-card__price">1499 грн</p>
                        </div>
                    </a>
                </div>
                <div class="product-card" data-category="other">
                    <a href="#" class="product-card__link">
                        <div class="product-card__image-wrap">
                            <img src="images/collection-1.webp" alt="Мотанка Продукт" class="product-card__image">
                                <div class="product-card__hover-overlay">
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__title">Мотанка Продукт</h3>
                            <p class="product-card__price">799 грн</p>
                        </div>
                    </a>
                </div>
                    <div class="product-card" data-category="motanky">
                    <a href="#" class="product-card__link">
                        <div class="product-card__image-wrap">
                            <img src="images/collection-1.webp" alt="Мотанка Продукт" class="product-card__image">
                                <div class="product-card__hover-overlay">
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__title">Мотанка Продукт</h3>
                            <p class="product-card__price">3499 грн</p>
                        </div>
                    </a>
                </div>
                    <div class="product-card" data-category="motanochka">
                    <a href="#" class="product-card__link">
                        <div class="product-card__image-wrap">
                            <img src="images/collection-1.webp" alt="Мотанка Продукт" class="product-card__image">
                                <div class="product-card__hover-overlay">
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__title">Мотанка Продукт</h3>
                            <p class="product-card__price">1999 грн</p>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>