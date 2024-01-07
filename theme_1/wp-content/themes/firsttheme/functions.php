<?php



// Theme styles adding
function first_theme_styles()
{
    wp_enqueue_style('Tailwind', get_template_directory_uri() . './dist/css/index.css', array(), filemtime(get_template_directory() . './dist/css/index.css'), 'all');
    wp_enqueue_style('Theme', get_template_directory_uri() . './dist/css/theme.css', array(), filemtime(get_template_directory() . './dist/css/index.css'), 'all');
    wp_enqueue_script('ThemeScript', get_template_directory_uri() . './dist/js/index.js', array('jquery'), filemtime(get_template_directory() . './dist/js/index.js'), true);
}
add_action('wp_enqueue_scripts', 'first_theme_styles');



// * register menus
function first_theme_config()
{
    // ! nav menus
    register_nav_menus(
        array(
            'first_theme_menu' => 'First Theme Menu',
            'first_theme_footer_menu' => 'First Theme Footer Menu',
        )
    );


    //! woocommerce support to theme 
    add_theme_support('woocommerce');

    //! woocommerce single product thumbnail
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');


    //! woocommerce product image changes
    add_theme_support(
        'woocommerce',
        array(
            'thumbnail_image_width' => 250,
            'single_image_width' => 250,
            'product_grid' => array(
                'default_rows' => 10,
                'min_rows' => 5,
                'max_rows' => 10,
                'default_columns' => 3,
                'min_columns' => 2,
                'max_columns' => 3,
            ),
        )
    );

    // ! adding sidebar
    register_sidebar(
        array(
            'name' => __('Primary Sidebar', 'theme_name'),
            'id' => 'sidebar-1',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
    register_sidebar(
        array(
            'name' => __('Secondary Sidebar', 'theme_name'),
            'id' => 'sidebar-2',
            'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li></ul>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );


    // ! content width
    if (!isset($content_width)) {
        $content_width = 600;
    }

    // ! disble wooocommerce default styles
    // if (class_exists('Woocommerce')) {
    //     add_filter('woocommerce_enqueue_styles', '__return_empty_array');
    // }
}
add_action('after_setup_theme', 'first_theme_config');


if (class_exists('woocommerce')) {
    require get_template_directory() . './includes/wc-modification.php';
}