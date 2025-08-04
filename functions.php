<?php

function veya_theme_scripts() {
    // Подключаем основной файл стилей
    wp_enqueue_style('veya-style', get_stylesheet_uri());

    // Подключаем Swiper CSS (если он используется)
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    
    // Подключаем Swiper JS
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), false, true);
    
    // Подключаем твой main.js
    // get_template_directory_uri() - это правильный путь к папке твоей темы
    wp_enqueue_script('veya-main-js', get_template_directory_uri() . '/main.js', array('swiper-js'), false, true);
}

// Добавляем нашу функцию в "хук" WordPress
add_action('wp_enqueue_scripts', 'veya_theme_scripts');

function create_product_post_type() {
    register_post_type('product',
        array(
            'labels'      => array(
                'name'          => __('Товари'),
                'singular_name' => __('Товар'),
            ),
            'public'      => true,
            'has_archive' => true,
            'rewrite'     => array('slug' => 'products'),
            'show_in_rest' => true, // Для редактора Gutenberg
            'supports'    => array('title', 'editor', 'thumbnail'), // Название, описание, картинка
        )
    );
}
add_action('init', 'create_product_post_type');

?>