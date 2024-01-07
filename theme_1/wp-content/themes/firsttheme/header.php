<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php bloginfo(); ?>
    </title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(''); ?>>
    <header class="bg-blue-400 p-6 flex justify-center">
        <?php
        wp_nav_menu(array('theme_location' => 'first_theme_menu'));
        ?>

        <a class="cart" href="<?php echo wc_get_cart_url() ?>">Cart<span class="items text-pink-500">
                <?php echo wc()->cart->get_cart_contents_count() ?>
            </span></a>
    </header>