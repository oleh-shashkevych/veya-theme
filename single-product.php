<?php get_header(); ?>

<main>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
        
        // --- Получаем все данные о товаре из ACF и WordPress ---
        $gallery_images = get_field('product_gallery');
        $height = get_field('product_height');
        $code = get_field('product_code');
        $price = get_field('product_price');
        $code = get_field('product_code');

    ?>
    <section class="product-page">
        <div class="container">
            <div class="product-page__inner" 
                 data-id="<?php the_ID(); ?>"
                 data-title="<?php the_title_attribute(); ?>"
                 data-price="<?php echo esc_attr($price); ?>"
                 data-link="<?php the_permalink(); ?>"
                data-code="<?php echo esc_attr($code); ?>">

                <div class="product-gallery">
                    <div class="swiper product-gallery-slider">
                        <div class="swiper-wrapper">
                            <?php 
                            // Проверяем, есть ли картинки в галерее
                            if( $gallery_images ): 
                                foreach( $gallery_images as $image ): ?>
                                    <div class="swiper-slide">
                                        <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                    </div>
                                <?php endforeach; 
                            // Если галерея пуста, но есть "Изображение записи", показываем его
                            elseif ( has_post_thumbnail() ): ?>
                                <div class="swiper-slide">
                                    <?php the_post_thumbnail('large'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>

                <div class="product-info">
                    <h1 class="product-info__title"><?php the_title(); ?></h1>
                    
                    <?php if ($height || $code): ?>
                    <div class="product-meta-container">
                        <div class="product-meta">
                            <?php if ($height): ?>
                                <span>висота: <?php echo esc_html($height); ?></span>
                            <?php endif; ?>
                            <?php if ($code): ?>
                                <span>код: <?php echo esc_html($code); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="product-description">
                        <?php the_content(); // Выводим основное описание товара из редактора ?>
                    </div>

                    <?php if ($price): ?>
                    <div class="product-actions">
                        <span class="product-price"><?php echo esc_html($price); ?> грн</span>
                        <button class="hero__btn add-to-cart-btn-product">В корзину</button>
                    </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>