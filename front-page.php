<?php get_header(); ?>

<main>
    <section class="hero">
        <div class="hero__background">
            <?php 
            $hero_images = get_field('hero_background_images');
            if( $hero_images ): 
                $is_first = true;
                foreach( $hero_images as $image ): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="hero__bg-img <?php if($is_first) { echo 'active'; $is_first = false; } ?>">
                <?php endforeach; 
            endif; ?>

            <?php if( $video = get_field('hero_background_video') ): ?>
                <video src="<?php echo esc_url($video['url']); ?>" class="hero__bg-video" autoplay muted loop playsinline></video>
            <?php endif; ?>

            <div class="hero__overlay"></div>
        </div>
        <div class="hero__content">
            <div class="container">
                <?php if ( $hero_heading = get_field('hero_heading') ): 
                    // Заменяем перенос строки на <br> для мобильной версии
                    $hero_heading_mobile = str_replace("\n", "<br>", $hero_heading);
                ?>
                    <h1 class="hero__text desktop-hidden"><?php echo esc_html($hero_heading); ?></h1>
                    <h1 class="hero__text mobile-hidden"><?php echo $hero_heading_mobile; ?></h1>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <section class="collections">
        <div class="container">
            <h2 class="collections__title">Колекції</h2>

            <?php
            $all_collections = get_terms(array(
                'taxonomy' => 'collection',
                'hide_empty' => false,
            ));

            if (!empty($all_collections) && !is_wp_error($all_collections)):

                $homepage_collections = array_filter($all_collections, function($term) {
                    return get_field('hide_on_homepage', $term) !== true;
                });

                if (!empty($homepage_collections)) {
                    usort($homepage_collections, function($a, $b) {
                        $order_a = (int) get_field('sort_order_homepage', $a);
                        $order_b = (int) get_field('sort_order_homepage', $b);
                        return $order_a <=> $order_b;
                    });
                }
            
                if (!empty($homepage_collections)):
            ?>

                <div class="collections__grid desktop-hidden">
                    <?php foreach ($homepage_collections as $collection):
                        $image = get_field('collection_image', $collection);
                        $title = get_field('collection_title', $collection);
                        $store_page_url = get_permalink(get_page_by_path('magazyn'));
                        
                        // --- НОВАЯ ЛОГИКА ГЕНЕРАЦИИ ССЫЛКИ ---
                        // 1. Проверяем, скрыта ли коллекция в фильтрах магазина.
                        $is_hidden_in_filters = get_field('hide_in_filters', $collection);
                        
                        // 2. По умолчанию ссылка ведет на чистую страницу магазина.
                        $link = $store_page_url;
                        
                        // 3. Если коллекция НЕ скрыта в фильтрах, добавляем параметр.
                        if (!$is_hidden_in_filters) {
                            $link = add_query_arg('collection', $collection->slug, $store_page_url);
                        }
                    ?>
                        <a href="<?php echo esc_url($link); ?>" class="collection-card">
                            <div class="collection-card__image-wrap">
                                <?php if ($image): ?>
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="collection-card__image">
                                <?php endif; ?>
                            </div>
                            <h3 class="collection-card__title"><?php echo esc_html($title ? $title : $collection->name); ?></h3>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="swiper collections-slider mobile-hidden">
                    <div class="swiper-wrapper">
                        <?php foreach ($homepage_collections as $collection):
                            $image = get_field('collection_image', $collection);
                            $title = get_field('collection_title', $collection);
                            $store_page_url = get_permalink(get_page_by_path('magazyn'));

                            // --- ПОВТОРЯЕМ НОВУЮ ЛОГИКУ И ЗДЕСЬ ---
                            $is_hidden_in_filters = get_field('hide_in_filters', $collection);
                            $link = $store_page_url;
                            if (!$is_hidden_in_filters) {
                                $link = add_query_arg('collection', $collection->slug, $store_page_url);
                            }
                        ?>
                            <div class="swiper-slide">
                                <a href="<?php echo esc_url($link); ?>" class="collection-card">
                                    <div class="collection-card__image-wrap">
                                        <?php if ($image): ?>
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="collection-card__image">
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="collection-card__title"><?php echo esc_html($title ? $title : $collection->name); ?></h3>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="collections__footer">
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('magazyn'))); ?>" class="hero__btn collections__btn">дивитись більше</a>
                    <div class="swiper-pagination collections__pagination mobile-hidden"></div>
                </div>

            <?php
                endif;
            endif;
            ?>
        </div>
    </section>
    <section class="about" id="about">
        <div class="container">
            <h2 class="about__title"><?php the_field('about_title'); ?></h2>
            <div class="about__inner">
                <div class="about__text-content">
                    <div class="about__text-wrapper">
                        <?php the_field('about_text'); ?>
                        <?php 
                        $about_button = get_field('about_button');
                        if( $about_button ): 
                            $link_url = $about_button['url'];
                            $link_title = $about_button['title'];
                            $link_target = $about_button['target'] ? $about_button['target'] : '_self';
                        ?>
                            <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" class="hero__btn about__btn"><?php echo esc_html($link_title); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="about__image-grid">
                    <?php for ($i = 1; $i <= 6; $i++): 
                        $image = get_field('about_image_' . $i);
                        if ($image): ?>
                            <div class="about__grid-item about__grid-item--<?php echo $i; ?>">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="about__grid-image">
                            </div>
                        <?php endif; 
                    endfor; ?>
                </div>
            </div>
        </div>
    </section>
    <?php if ( $cta_bg = get_field('cta_background_image') ): ?>
    <section class="cta-banner" style="background-image: url('<?php echo esc_url($cta_bg['url']); ?>');">
        <div class="cta-banner__overlay"></div>
        <div class="container">
            <div class="cta-banner__content">
                <h2 class="cta-banner__title"><?php the_field('cta_title'); ?></h2>
                <p class="cta-banner__title"><?php the_field('cta_subtitle'); ?></p>
                <?php 
                $cta_button = get_field('cta_button');
                if( $cta_button ): 
                    $link_url = $cta_button['url'];
                    $link_title = $cta_button['title'];
                    $link_target = $cta_button['target'] ? $cta_button['target'] : '_self';
                ?>
                    <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" class="hero__btn cta-banner__btn"><?php echo esc_html($link_title); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="creativity" id="creativity">
        <div class="container">
            <h2 class="creativity__title"><?php the_field('creativity_title'); ?></h2>
            <div class="creativity__inner">
                <div class="creativity__text-content">
                    <div class="creativity__text-wrapper">
                        <?php the_field('creativity_text'); ?>
                        <div class="creativity__socials">
                            <?php if ( $tiktok_url_creat = get_field('tiktok_url', 'option') ): ?>
                                <a href="<?php echo esc_url($tiktok_url_creat); ?>" target="_blank" rel="noopener noreferrer" class="creativity__social-link" aria-label="TikTok">
                                    <svg fill="#000000" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>tiktok</title> <path d="M16.656 1.029c1.637-0.025 3.262-0.012 4.886-0.025 0.054 2.031 0.878 3.859 2.189 5.213l-0.002-0.002c1.411 1.271 3.247 2.095 5.271 2.235l0.028 0.002v5.036c-1.912-0.048-3.71-0.489-5.331-1.247l0.082 0.034c-0.784-0.377-1.447-0.764-2.077-1.196l0.052 0.034c-0.012 3.649 0.012 7.298-0.025 10.934-0.103 1.853-0.719 3.543-1.707 4.954l0.020-0.031c-1.652 2.366-4.328 3.919-7.371 4.011l-0.014 0c-0.123 0.006-0.268 0.009-0.414 0.009-1.73 0-3.347-0.482-4.725-1.319l0.040 0.023c-2.508-1.509-4.238-4.091-4.558-7.094l-0.004-0.041c-0.025-0.625-0.037-1.25-0.012-1.862 0.49-4.779 4.494-8.476 9.361-8.476 0.547 0 1.083 0.047 1.604 0.136l-0.056-0.008c0.025 1.849-0.050 3.699-0.050 5.548-0.423-0.153-0.911-0.242-1.42-0.242-1.868 0-3.457 1.194-4.045 2.861l-0.009 0.030c-0.133 0.427-0.21 0.918-0.21 1.426 0 0.206 0.013 0.41 0.037 0.61l-0.002-0.024c0.332 2.046 2.086 3.59 4.201 3.59 0.061 0 0.121-0.001 0.181-0.004l-0.009 0c1.463-0.044 2.733-0.831 3.451-1.994l0.010-0.018c0.267-0.372 0.45-0.822 0.511-1.311l0.001-0.014c0.125-2.237 0.075-4.461 0.087-6.698 0.012-5.036-0.012-10.060 0.025-15.083z"></path> </g></svg>
                                </a>
                            <?php endif; ?>

                            <?php if ( $instagram_url_creat = get_field('instagram_url', 'option') ): ?>
                                <a href="<?php echo esc_url($instagram_url_creat); ?>" target="_blank" rel="noopener noreferrer" class="creativity__social-link" aria-label="Instagram">
                                    <svg fill="#000000" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>instagram</title> <path d="M25.805 7.996c0 0 0 0.001 0 0.001 0 0.994-0.806 1.799-1.799 1.799s-1.799-0.806-1.799-1.799c0-0.994 0.806-1.799 1.799-1.799v0c0.993 0.001 1.798 0.805 1.799 1.798v0zM16 20.999c-2.761 0-4.999-2.238-4.999-4.999s2.238-4.999 4.999-4.999c2.761 0 4.999 2.238 4.999 4.999v0c0 0 0 0.001 0 0.001 0 2.76-2.237 4.997-4.997 4.997-0 0-0.001 0-0.001 0h0zM16 8.3c0 0 0 0-0 0-4.253 0-7.7 3.448-7.7 7.7s3.448 7.7 7.7 7.7c4.253 0 7.7-3.448 7.7-7.7v0c0-0 0-0 0-0.001 0-4.252-3.447-7.7-7.7-7.7-0 0-0 0-0.001 0h0zM16 3.704c4.003 0 4.48 0.020 6.061 0.089 1.003 0.012 1.957 0.202 2.84 0.538l-0.057-0.019c1.314 0.512 2.334 1.532 2.835 2.812l0.012 0.034c0.316 0.826 0.504 1.781 0.516 2.778l0 0.005c0.071 1.582 0.087 2.057 0.087 6.061s-0.019 4.48-0.092 6.061c-0.019 1.004-0.21 1.958-0.545 2.841l0.019-0.058c-0.258 0.676-0.64 1.252-1.123 1.726l-0.001 0.001c-0.473 0.484-1.049 0.866-1.692 1.109l-0.032 0.011c-0.829 0.316-1.787 0.504-2.788 0.516l-0.005 0c-1.592 0.071-2.061 0.087-6.072 0.087-4.013 0-4.481-0.019-6.072-0.092-1.008-0.019-1.966-0.21-2.853-0.545l0.059 0.019c-0.676-0.254-1.252-0.637-1.722-1.122l-0.001-0.001c-0.489-0.47-0.873-1.047-1.114-1.693l-0.010-0.031c-0.315-0.828-0.506-1.785-0.525-2.785l-0-0.008c-0.056-1.575-0.076-2.061-0.076-6.053 0-3.994 0.020-4.481 0.076-6.075 0.019-1.007 0.209-1.964 0.544-2.85l-0.019 0.059c0.247-0.679 0.632-1.257 1.123-1.724l0.002-0.002c0.468-0.492 1.045-0.875 1.692-1.112l0.031-0.010c0.823-0.318 1.774-0.509 2.768-0.526l0.007-0c1.593-0.056 2.062-0.075 6.072-0.075zM16 1.004c-4.074 0-4.582 0.019-6.182 0.090-1.315 0.028-2.562 0.282-3.716 0.723l0.076-0.025c-1.040 0.397-1.926 0.986-2.656 1.728l-0.001 0.001c-0.745 0.73-1.333 1.617-1.713 2.607l-0.017 0.050c-0.416 1.078-0.67 2.326-0.697 3.628l-0 0.012c-0.075 1.6-0.090 2.108-0.090 6.182s0.019 4.582 0.090 6.182c0.028 1.315 0.282 2.562 0.723 3.716l-0.025-0.076c0.796 2.021 2.365 3.59 4.334 4.368l0.052 0.018c1.078 0.415 2.326 0.669 3.628 0.697l0.012 0c1.6 0.075 2.108 0.090 6.182 0.090s4.582-0.019 6.182-0.090c1.315-0.029 2.562-0.282 3.716-0.723l-0.076 0.026c2.021-0.796 3.59-2.365 4.368-4.334l0.018-0.052c0.416-1.078 0.669-2.326 0.697-3.628l0-0.012c0.075-1.6 0.090-2.108 0.090-6.182s-0.019-4.582-0.090-6.182c-0.029-1.315-0.282-2.562-0.723-3.716l0.026 0.076c-0.398-1.040-0.986-1.926-1.729-2.656l-0.001-0.001c-0.73-0.745-1.617-1.333-2.607-1.713l-0.050-0.017c-1.078-0.416-2.326-0.67-3.628-0.697l-0.012-0c-1.6-0.075-2.108-0.090-6.182-0.090z"></path> </g></svg>
                                </a>
                            <?php endif; ?>

                            <?php if ( $youtube_url_creat = get_field('youtube_url', 'option') ): ?>
                                <a href="<?php echo esc_url($youtube_url_creat); ?>" target="_blank" rel="noopener noreferrer"class="creativity__social-link" aria-label="YouTube">
                                    <svg fill="#000000" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>youtube</title> <path d="M12.932 20.459v-8.917l7.839 4.459zM30.368 8.735c-0.354-1.301-1.354-2.307-2.625-2.663l-0.027-0.006c-3.193-0.406-6.886-0.638-10.634-0.638-0.381 0-0.761 0.002-1.14 0.007l0.058-0.001c-0.322-0.004-0.701-0.007-1.082-0.007-3.748 0-7.443 0.232-11.070 0.681l0.434-0.044c-1.297 0.363-2.297 1.368-2.644 2.643l-0.006 0.026c-0.4 2.109-0.628 4.536-0.628 7.016 0 0.088 0 0.176 0.001 0.263l-0-0.014c-0 0.074-0.001 0.162-0.001 0.25 0 2.48 0.229 4.906 0.666 7.259l-0.038-0.244c0.354 1.301 1.354 2.307 2.625 2.663l0.027 0.006c3.193 0.406 6.886 0.638 10.634 0.638 0.38 0 0.76-0.002 1.14-0.007l-0.058 0.001c0.322 0.004 0.702 0.007 1.082 0.007 3.749 0 7.443-0.232 11.070-0.681l-0.434 0.044c1.298-0.362 2.298-1.368 2.646-2.643l0.006-0.026c0.399-2.109 0.627-4.536 0.627-7.015 0-0.088-0-0.176-0.001-0.263l0 0.013c0-0.074 0.001-0.162 0.001-0.25 0-2.48-0.229-4.906-0.666-7.259l0.038 0.244z"></path> </g></svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php if( have_rows('creativity_features') ): ?>
                    <div class="creativity__image-container mobile-hidden">
                        <?php while( have_rows('creativity_features') ): the_row(); 
                            $image = get_sub_field('feature_image');
                            $text = get_sub_field('feature_text');
                            $link = get_sub_field('feature_link');
                        ?>
                            <div class="creativity__image-content">
                                <div class="creativity__image-wrap">
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="creativity__image">
                                </div>
                                <p class="creativity__text"><?php echo esc_html($text); ?></p>
                                <a class="creativity__listen" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target']); ?>"><?php echo esc_html($link['title']); ?></a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="swiper creativity-slider desktop-hidden">
                        <div class="swiper-wrapper">
                            <?php while( have_rows('creativity_features') ): the_row(); 
                                
                                // --- НОВАЯ ЛОГИКА ДЛЯ МОБИЛЬНОГО ИЗОБРАЖЕНИЯ ---
                                // 1. Получаем оба изображения: мобильное и десктопное.
                                $image_mobile = get_sub_field('feature_image_mobile');
                                $image_desktop = get_sub_field('feature_image');
                                
                                // 2. Выбираем, какое использовать: если мобильное есть, берем его, иначе - десктопное.
                                $final_image = $image_mobile ? $image_mobile : $image_desktop;

                                // Получаем остальные поля как обычно
                                $text = get_sub_field('feature_text');
                                $link = get_sub_field('feature_link');
                            ?>
                                <div class="swiper-slide">
                                    <div class="creativity__swiper-content">
                                        <div class="creativity__swiper-wrap">
                                            <?php // Используем переменную $final_image, которая содержит нужное изображение ?>
                                            <img src="<?php echo esc_url($final_image['url']); ?>" alt="<?php echo esc_attr($final_image['alt']); ?>" class="creativity__swiper-image">
                                        </div>
                                        <p class="creativity__swiper-text"><?php echo esc_html($text); ?></p>
                                        <a class="creativity__swiper-listen" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target']); ?>"><?php echo esc_html($link['title']); ?></a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        <div class="swiper-pagination creativity__pagination"></div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <section class="faq" id="faq">
        <div class="container">
            <h2 class="faq__title"><?php the_field('faq_title'); ?></h2>
            <?php 
            if( have_rows('faq_items') ):
                $faq_items = get_field('faq_items');
                $middle_index = ceil(count($faq_items) / 2);
                $faq_col_1 = array_slice($faq_items, 0, $middle_index);
                $faq_col_2 = array_slice($faq_items, $middle_index);
            ?>
            <div class="faq__list">
                <div class="faq__column">
                    <?php foreach ($faq_col_1 as $item): ?>
                        <div class="faq__item">
                            <button class="faq__question">
                                <span><?php echo esc_html($item['question']); ?></span>
                                <span class="faq__icon">+</span>
                            </button>
                            <div class="faq__answer">
                                <?php echo $item['answer']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="faq__column">
                    <?php foreach ($faq_col_2 as $item): ?>
                        <div class="faq__item">
                            <button class="faq__question">
                                <span><?php echo esc_html($item['question']); ?></span>
                                <span class="faq__icon">+</span>
                            </button>
                            <div class="faq__answer">
                                <?php echo $item['answer']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>