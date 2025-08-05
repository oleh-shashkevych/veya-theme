<?php /* Template Name: Store Page */ ?>
<?php get_header(); ?>

<main>
    <?php
    // Получаем данные из ACF полей в переменные
    $hero_title = get_field('store_hero_title');
    $hero_bg = get_field('store_hero_background');
    ?>

    <section class="store-hero" <?php if ($hero_bg): ?>style="background-image: url('<?php echo esc_url($hero_bg['url']); ?>');"<?php endif; ?>>
        <div class="store-hero__overlay"></div>
        <div class="container">
            <div class="store-hero__content">
                <h1 class="store-hero__title">
                    <?php 
                    // Если поле ACF для заголовка заполнено, выводим его.
                    // Если нет - выводим стандартный заголовок страницы для подстраховки.
                    echo $hero_title ? esc_html($hero_title) : get_the_title(); 
                    ?>
                </h1>
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
                    <?php
                    $all_collections = get_terms(['taxonomy' => 'collection', 'hide_empty' => false]);

                    if (!empty($all_collections) && !is_wp_error($all_collections)):
                        
                        // 1. Фильтруем коллекции для табов
                        $filter_collections = array_filter($all_collections, function($term) {
                            return !get_field('hide_in_filters', $term);
                        });

                        // 2. Сортируем коллекции для табов
                        usort($filter_collections, function($a, $b) {
                            $order_a = get_field('sort_order_filters', $a);
                            $order_b = get_field('sort_order_filters', $b);
                            return $order_a - $order_b;
                        });

                        foreach ($filter_collections as $collection): // Используем новый массив
                            $tab_title = get_field('collection_tab_title', $collection);
                    ?>
                        <button class="filter-btn" data-filter="<?php echo esc_attr($collection->slug); ?>">
                            <?php echo esc_html($tab_title ? $tab_title : $collection->name); ?>
                        </button>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>

            <div class="product-grid">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => -1, // Показать все товары
                );
                $products_query = new WP_Query($args);

                if ($products_query->have_posts()) :
                    while ($products_query->have_posts()) : $products_query->the_post();
                        // --- Получаем все нужные данные для карточки ---
                        $price = get_field('product_price');
                        $product_collections = get_the_terms(get_the_ID(), 'collection');
                        $collection_slugs = '';
                        if ($product_collections) {
                            $collection_slugs = implode(' ', wp_list_pluck($product_collections, 'slug'));
                        }
                ?>
                    
                    <div class="product-card" 
                        data-category="<?php echo esc_attr($collection_slugs); ?>"
                        data-id="<?php the_ID(); ?>"
                        data-title="<?php the_title_attribute(); ?>"
                        data-price="<?php echo esc_attr($price); ?>"
                        data-link="<?php the_permalink(); ?>">
                        
                        <a href="<?php the_permalink(); ?>" class="product-card__link">
                            <div class="product-card__image-wrap">
                                <?php 
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('medium_large', ['class' => 'product-card__image']);
                                } else {
                                    // Можно поставить заглушку, если у товара нет картинки
                                    echo '<img src="' . get_template_directory_uri() . '/images/placeholder.png" alt="Зображення відсутнє" class="product-card__image">';
                                }
                                ?>
                                <div class="product-card__hover-overlay">
                                    <button class="add-to-cart-btn">В корзину</button>
                                </div>
                            </div>
                            <div class="product-card__info">
                                <h3 class="product-card__title"><?php the_title(); ?></h3>
                                <?php if ($price): ?>
                                    <p class="product-card__price"><?php echo esc_html($price); ?> грн</p>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>Товарів у цій категорії ще немає.</p>';
                endif;
                ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>