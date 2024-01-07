<?php



// ! woocommerce archive page {
function first_theme_before_wrapper_add()
{
    echo '<div class="custom class">';
}

add_action('woocommerce_before_main_content', 'first_theme_before_wrapper_add', 5);

function first_theme_after_wrapper_add()
{
    echo '</div>';
}

add_action('woocommerce_after_main_content', 'first_theme_after_wrapper_add', 5);

// ! woocommerce archive page }



// ! remove action woocommerce sidebar {
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
// ! remove action woocommerce sidebar }



// ! remove shop page title {

// only true or false acceptable
add_filter('woocommerce_show_page_title', 'remove_shop_page_title');
function remove_shop_page_title()
{
    return false;
}
// ! remove shop page title }


// ! add post excerpt to the title {
// add_action('woocommerce_after_shop_loop_item_title', 'the_excerpt', 1);
// ! add post excerpt to the title }


// ! remove default side bar {
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
// ! remove default side bar }


// ! add breadcrump to the single product page {
add_action('woocommerce_before_single_product', 'woocommerce_breadcrumb', 20);
// ! add breadcrump to the single product page }

?>