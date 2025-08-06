// Оборачиваем весь код в обработчик события, чтобы он выполнялся после полной загрузки DOM
document.addEventListener('DOMContentLoaded', () => {

    // ======== BURGER MENU & HEADER LOGIC ========
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.header__nav');
    const headerWrapper = document.querySelector('.header');
    const body = document.querySelector('body');

    if (burger) {
        burger.addEventListener('click', () => {
            burger.classList.toggle('active');
            nav.classList.toggle('active');
            headerWrapper.classList.toggle('active');
            body.classList.toggle('no-scroll');
        });
    }

    // ======== FIXED HEADER ON SCROLL ========
    const header = document.querySelector('.header');
    if (header) {
        const handleHeaderScroll = () => {
            if (window.scrollY > 10) {
                header.classList.add('fixed');
            } else {
                header.classList.remove('fixed');
            }
        };
        window.addEventListener('scroll', handleHeaderScroll);
        handleHeaderScroll(); // Проверка при загрузке
    }


    // ======== HERO SECTION IMAGE SLIDER (HOMEPAGE) ========
    const heroImages = document.querySelectorAll('.hero__bg-img');
    if (heroImages.length > 1 && window.innerWidth > 768) {
        let currentImageIndex = 0;
        let zCounter = 1;

        function showNextImage() {
            const nextImageIndex = (currentImageIndex + 1) % heroImages.length;
            const nextImage = heroImages[nextImageIndex];

            nextImage.style.zIndex = zCounter++;
            nextImage.classList.add('active');

            heroImages[currentImageIndex].classList.remove('active');
            currentImageIndex = nextImageIndex;
        }
        setInterval(showNextImage, 4000);
    }


    // ======== COLLECTIONS SLIDER (SWIPER ON HOMEPAGE) ========
    if (document.querySelector('.collections-slider')) {
        const collectionsSlider = new Swiper('.collections-slider', {
            // Optional parameters
            loop: true,
            spaceBetween: 15,
            speed: 2500,
            slidesPerGroup: 1,
        
            // Конфігурація автопрокрутки
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
        
            // Pagination (точки)
            pagination: {
                el: '.collections__pagination',
                clickable: true,
            },
        
            // Responsive breakpoints
            breakpoints: {
                320: { slidesPerView: 1, slidesPerGroup: 1 },
                576: { slidesPerView: 2, slidesPerGroup: 2 },
                992: { slidesPerView: 3, slidesPerGroup: 3 },
                1200: { slidesPerView: 4, slidesPerGroup: 4 }
            }
        });

        // Зупиняємо автопрокрутку одразу після ініціалізації
        collectionsSlider.autoplay.stop();
        
        // Знаходимо сам елемент слайдера для спостереження
        const sliderElement = document.querySelector('.collections-slider');
        
        // Створюємо спостерігача (Intersection Observer)
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                // Якщо елемент з'явився в зоні видимості
                if (entry.isIntersecting) {
                    // ОНОВЛЕНО: Додаємо одноразовий слухач на подію завершення анімації
                    collectionsSlider.once('slideChangeTransitionEnd', function () {
                        // Цей код спрацює, коли перша прокрутка закінчиться.
                        // Тепер запускаємо стандартну автопрокрутку.
                        collectionsSlider.autoplay.start();
                    });
                    
                    // Запускаємо першу прокрутку негайно
                    collectionsSlider.slideNext();
                    
                    // Припиняємо спостереження
                    observer.unobserve(sliderElement);
                }
            });
        }, { threshold: 0.1 });
        
        // Починаємо спостереження за елементом слайдера
        observer.observe(sliderElement);
    }


    // ======== ABOUT US SECTION POPUP ========
    const gridImages = document.querySelectorAll('.about__grid-image');
    const popup = document.querySelector('.popup');
    if (popup) {
        const popupImg = document.querySelector('.popup__img');
        const popupClose = document.querySelector('.popup__close');

        function openPopup(e) {
            popup.classList.add('active');
            popupImg.src = e.target.src;
            body.classList.add('no-scroll');
        }

        function closePopup() {
            popup.classList.remove('active');
            body.classList.remove('no-scroll');
        }

        gridImages.forEach(image => image.addEventListener('click', openPopup));
        popupClose.addEventListener('click', closePopup);
        popup.addEventListener('click', (e) => {
            if (e.target === popup) closePopup();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && popup.classList.contains('active')) closePopup();
        });
    }


    // ======== FAQ ACCORDION ========
    const faqItems = document.querySelectorAll('.faq__item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq__question');
        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            faqItems.forEach(otherItem => otherItem.classList.remove('active'));
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });


    // ======== HEIGHT ALIGNMENT SCRIPTS ========
    function alignElementHeights() {
        // ... твой код для выравнивания высот, если он нужен ...
    }
    window.addEventListener('load', alignElementHeights);
    window.addEventListener('resize', alignElementHeights);


    // ======== PRODUCT PAGE GALLERY SLIDER (SWIPER) ========
    if (document.querySelector('.product-gallery-slider')) {
        new Swiper('.product-gallery-slider', {
            loop: true,
            spaceBetween: 10,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }

    // ======== CREATIVITY SLIDER (SWIPER) ========
    if (document.querySelector('.creativity-slider')) {
        new Swiper('.creativity-slider', {
            loop: true,
            spaceBetween: 10,
            pagination: {
                el: '.creativity__pagination',
                clickable: true,
            },
            autoplay: {
                delay: 4000,
            },
            speed: 2500,
        });
    }
    
    // ======== STORE HERO PARALLAX ========
    const storeHero = document.querySelector('.store-hero');
    if (storeHero) {
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    storeHero.style.backgroundPosition = `50% calc(50% + ${window.scrollY * 0.5}px)`;
                    ticking = false;
                });
                ticking = true;
            }
        });
    }
    
    // ======== STORE FILTER LOGIC (DYNAMIC COLLECTIONS) ========
    const filtersContainer = document.querySelector('.store-filters');
    if (filtersContainer) {
        const filterToggle = filtersContainer.querySelector('.filter-toggle');
        const filterList = filtersContainer.querySelector('.filter-list');
        const filterButtons = filterList.querySelectorAll('.filter-btn');
        const productCards = document.querySelectorAll('.product-grid .product-card');
        const filterToggleText = filterToggle.querySelector('span');

        // Логика для мобильного аккордеона
        filterToggle.addEventListener('click', () => {
            filtersContainer.classList.toggle('active');
        });

        // Функция фильтрации
        const filterProducts = (filterValue) => {
            // Обновляем текст главной кнопки на мобилке
            const filterList = document.querySelector('.filter-list'); // Нам нужен доступ к списку
            const filterToggleText = document.querySelector('.filter-toggle span');
            const activeButton = filterList.querySelector(`.filter-btn[data-filter="${filterValue}"]`);
            if (activeButton && filterToggleText) {
                filterToggleText.textContent = activeButton.textContent;
            }
            
            // Обновляем активное состояние кнопок
            const filterButtons = filterList.querySelectorAll('.filter-btn');
            filterButtons.forEach(button => {
                button.classList.toggle('active', button.dataset.filter === filterValue);
            });

            // Фильтруем карточки товаров
            const productCards = document.querySelectorAll('.product-grid .product-card');
            productCards.forEach(card => {
                const cardCategories = card.dataset.category || '';

                // --- НОВАЯ ЛОГИКА (ПРАВИЛЬНАЯ) ---
                // 1. Разбиваем строку с категориями на массив отдельных слов (слагов)
                const categoriesArray = cardCategories.split(' ');
                
                // 2. Проверяем точное совпадение в массиве
                if (filterValue === 'all' || categoriesArray.includes(filterValue)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });

            // Закрываем аккордеон на мобилке после выбора
            const filtersContainer = document.querySelector('.store-filters');
            if (window.innerWidth <= 768) {
                filtersContainer.classList.remove('active');
            }
        };

        // Клик по кнопке фильтра
        filterList.addEventListener('click', (event) => {
            if (event.target.matches('.filter-btn')) {
                const filterValue = event.target.dataset.filter;
                filterProducts(filterValue);
            }
        });

        // Проверка URL на наличие параметра при загрузке страницы
        const urlParams = new URLSearchParams(window.location.search);
        const collectionFromUrl = urlParams.get('collection');

        if (collectionFromUrl) {
            // Если параметр есть, запускаем фильтрацию по нему
            filterProducts(collectionFromUrl);
        }
    }


    // ======== SIMPLE CART LOGIC (NO WOOCOMMERCE) ========

    // Функция для обновления счетчика в хедере
    const updateCartCounter = () => {
        const counterElement = document.querySelector('.cart-counter');
        if (!counterElement) return;

        const cart = JSON.parse(localStorage.getItem('veyaCart')) || [];
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);

        counterElement.textContent = totalItems;

        if (totalItems > 0) {
            counterElement.classList.add('visible');
        } else {
            counterElement.classList.remove('visible');
        }
    };
    
    // --- Добавление товара в корзину ---
    function addToCart(product) {
        let cart = JSON.parse(localStorage.getItem('veyaCart')) || [];
        const existingProductIndex = cart.findIndex(item => item.id === product.id);

        if (existingProductIndex > -1) {
            cart[existingProductIndex].quantity++;
        } else {
            cart.push(product);
        }
        localStorage.setItem('veyaCart', JSON.stringify(cart));
        console.log('Cart updated:', cart);
        
        updateCartCounter(); // --- ДОБАВЛЕНО ---
    }
    
    // Универсальный обработчик для всех кнопок "В корзину"
    document.body.addEventListener('click', (e) => {
        if (e.target.matches('.add-to-cart-btn') || e.target.matches('.add-to-cart-btn-product')) {
             e.preventDefault();
             const button = e.target;
             const productDataElement = button.closest('[data-id]'); // Ищем ближайшего родителя с data-атрибутами
             
             if(productDataElement) {
                const product = {
                    id: productDataElement.dataset.id,
                    title: productDataElement.dataset.title,
                    price: parseFloat(productDataElement.dataset.price),
                    link: productDataElement.dataset.link,
                    code: productDataElement.dataset.code,
                    quantity: 1
                };
                addToCart(product);
    
                // Обратная связь
                const originalText = button.textContent;
                button.textContent = 'Додано в корзину!';
                button.disabled = true;
                setTimeout(() => {
                    button.textContent = originalText;
                    button.disabled = false;
                }, 2000);
             }
        }
    });

    // ======== ЛОГИКА СТРАНИЦЫ КОРЗИНЫ ========
    const cartPageContainer = document.getElementById('cart-container');
    if (cartPageContainer) {

        const updateHiddenFields = () => {
            if (typeof jQuery === 'undefined') return;

            const cartData = JSON.parse(localStorage.getItem('veyaCart')) || [];
            
            // --- УКАЖИ ЗДЕСЬ СВОИ ID ---
            const formId = 1; 
            const listFieldId = 9; // Судя по твоему HTML (id="field_1_9"), ID поля-списка = 9
            const totalFieldId = 10;    // ПРОВЕРЬ ID ПОЛЯ "ИТОГОВАЯ СУММА" И ПОСТАВЬ СЮДА

            const listFieldContainer = jQuery(`#field_${formId}_${listFieldId}`);
            const totalInput = jQuery(`#input_${formId}_${totalFieldId}`);

            if (listFieldContainer.length && totalInput.length) {
                // 1. Очищаем все строки списка, кроме первой
                listFieldContainer.find('.gfield_list_group:not(:first)').remove();

                if (cartData.length > 0) {
                    const total = cartData.reduce((sum, item) => sum + item.price * item.quantity, 0);

                    // 2. Заполняем строки данными для каждого товара в корзине
                    cartData.forEach((item, index) => {
                        // Для всех товаров, кроме первого, "нажимаем" на плюсик для создания новой строки
                        if (index > 0) {
                            listFieldContainer.find('.add_list_item').trigger('click');
                        }
                        
                        // Находим текущую строку (по ее индексу)
                        const currentRow = listFieldContainer.find('.gfield_list_group').eq(index);
                        
                        // Находим инпуты в колонках и заполняем их
                        currentRow.find(`.gfield_list_${listFieldId}_cell1 input`).val(item.code || ''); // Код товара
                        currentRow.find(`.gfield_list_${listFieldId}_cell2 input`).val(item.title);      // Название
                        currentRow.find(`.gfield_list_${listFieldId}_cell3 input`).val(item.price);      // Цена
                        currentRow.find(`.gfield_list_${listFieldId}_cell4 input`).val(item.quantity);  // Количество
                    });

                    // 3. Устанавливаем итоговую сумму
                    totalInput.val(total.toFixed(2));

                } else {
                    // Если корзина пуста, очищаем инпуты в первой (и единственной) строке
                    listFieldContainer.find('.gfield_list_group:first input').val('');
                    totalInput.val('');
                }
            }
        };

        const renderCart = (isAfterSubmission = false) => {
            let cart = JSON.parse(localStorage.getItem('veyaCart')) || [];
            const orderForm = document.getElementById('order-form-wrapper');
            let total = 0;

            if (cart.length === 0) {
                if (isAfterSubmission) {
                    cartPageContainer.innerHTML = '<p style="font-size: 1.2em; text-align: center; color: green;">Дякуємо за ваше замовлення! Ми скоро з вами зв\'яжемося.</p>';
                } else {
                    cartPageContainer.innerHTML = '<p style="text-align: center;">Ваша корзина порожня.</p>';
                }
                if (orderForm) orderForm.style.display = 'none';
                updateHiddenFields();
                return;
            }

            if (orderForm) orderForm.style.display = 'block';

            const cartHTML = cart.map(item => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                return `
                    <div class="cart-item" data-id="${item.id}">
                        <a href="${item.link}" class="cart-item-title">${item.title}</a>
                        <div class="cart-item-details">
                            <span class="cart-item-price">${item.price} грн</span>
                            <input type="number" class="item-quantity" value="${item.quantity}" min="1">
                            <span class="cart-item-total">Сума: ${itemTotal.toFixed(2)} грн</span>
                        </div>
                        <button class="remove-item">&times;</button>
                    </div>
                `;
            }).join('');

            cartPageContainer.innerHTML = cartHTML + `<hr><p style="text-align: right; font-size: 1.2em;"><strong>Всього: ${total.toFixed(2)} грн</strong></p>`;
            
            updateHiddenFields();
        };

        // --- Остальные функции (updateQuantity, removeItem, обработчики событий) остаются без изменений ---
        const updateQuantity = (productId, newQuantity) => {
            let cart = JSON.parse(localStorage.getItem('veyaCart')) || [];
            const productIndex = cart.findIndex(item => item.id === productId);
            if (productIndex > -1 && newQuantity > 0) {
                cart[productIndex].quantity = parseInt(newQuantity, 10);
                localStorage.setItem('veyaCart', JSON.stringify(cart));
                renderCart();
                updateCartCounter();
            }
        };

        const removeItem = (productId) => {
            let cart = JSON.parse(localStorage.getItem('veyaCart')) || [];
            cart = cart.filter(item => item.id !== productId);
            localStorage.setItem('veyaCart', JSON.stringify(cart));
            renderCart();
            updateCartCounter();
        };

        cartPageContainer.addEventListener('change', (e) => {
            if (e.target.classList.contains('item-quantity')) {
                const productId = e.target.closest('.cart-item').dataset.id;
                updateQuantity(productId, e.target.value);
            }
        });
        cartPageContainer.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-item')) {
                const productId = e.target.closest('.cart-item').dataset.id;
                removeItem(productId);
            }
        });

        if (typeof jQuery !== 'undefined') {
            jQuery(document).on('gform_confirmation_loaded', function(event, form_id) {
                console.log('Заказ успешно отправлен, очищаем корзину.');
                localStorage.removeItem('veyaCart');
                renderCart(true);
            });
        }

        renderCart();
    }
    updateCartCounter();

}); // Конец DOMContentLoaded