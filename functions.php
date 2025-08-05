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

function create_collection_taxonomy() {
    $labels = array(
        'name'              => _x( 'Колекції', 'taxonomy general name' ),
        'singular_name'     => _x( 'Колекція', 'taxonomy singular name' ),
        'search_items'      => __( 'Шукати колекції' ),
        'all_items'         => __( 'Усі колекції' ),
        'parent_item'       => __( 'Батьківська колекція' ),
        'parent_item_colon' => __( 'Батьківська колекція:' ),
        'edit_item'         => __( 'Редагувати колекцію' ),
        'update_item'       => __( 'Оновити колекцію' ),
        'add_new_item'      => __( 'Додати нову колекцію' ),
        'new_item_name'     => __( 'Назва нової колекції' ),
        'menu_name'         => __( 'Колекції' ),
    );

    $args = array(
        'hierarchical'      => true, // Как рубрики, а не метки
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'collection' ),
        'show_in_rest'      => true, // Важно для ACF и Gutenberg
    );

    // 'product' - это слаг твоего Custom Post Type
    register_taxonomy( 'collection', array( 'product' ), $args );
}
add_action( 'init', 'create_collection_taxonomy', 0 );

function veya_register_menus() {
    register_nav_menus(
        array(
            'header_menu' => __( 'Меню в шапці' ),
        )
    );
}
add_action( 'init', 'veya_register_menus' );

function veya_theme_setup() {
    // Включаем поддержку динамического <title> тега.
    add_theme_support( 'title-tag' );

    // Включаем поддержку миниатюр (Изображений записи) для всей темы.
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'veya_theme_setup' );

if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        
        /* (string) The title displayed on the options page. Required. */
        'page_title' => 'Загальні налаштування теми',
        
        /* (string) The title displayed in the main menu. Required. */
        'menu_title' => 'Налаштування теми',
        
        /* (string) The slug name to refer to this menu. Dashes only. Required. */
        'menu_slug' => 'theme-general-settings',
        
        /* (string) The capability required for this menu to be displayed to. */
        'capability' => 'edit_posts',
        
        /* (int|string) The position in the menu order this menu should appear. */
        'position' => false,

        /* (string) The icon class for this menu. */
        'icon_url' => 'dashicons-admin-settings',
        
        /* (boolean) If set to true, this options page will redirect to the first child page (if a child page exists). */
        'redirect' => false,
        
        /* (int|string) The '$post_id' to save/load data to/from. Can be set to a numeric post ID or a string like 'user_2'. */
        'post_id' => 'options',
        
    ));
    
}

?>