<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php /*include 'includes/favicons.php';*/ ?>

	<?php wp_head(); ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">


</head>

<body <?php body_class(); ?>>

<div class="page-wrapper">

<div id="site-header">

    <div class="container-brand">
        <?php include 'includes/site-branding.php'; ?>
    </div>

    <div id="container-main-menu">

        <a href="/" class="menu hamburger">
            <span class="menu-icon-line-1 menu-icon-line"></span>
            <span class="menu-icon-line-2 menu-icon-line"></span>
            <span class="menu-icon-line-3 menu-icon-line"></span>
        </a>

        <nav>

            <div class="main-menu">

                <?php
                wp_nav_menu([
                    'menu'            => 'Main Menu',
                    'theme_location'  => 'top',
                    'container'       => 'div',
                    'menu_id'         => 'main-menu',
                    'menu_class'      => 'main-menu',
                    'depth'           => 2,
                    //'walker' => new acme_menu_Walker()
                ]);
                ?>

            </div>
        </nav>
    </div>

</div>


