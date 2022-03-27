<?php
/**
 * Template header(header.php)
 * @package WordPress
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Italiana&family=Montserrat:ital,wght@0,300;0,600;1,400&display=swap" as="style">
    <title>Test task</title>
    <?php wp_head(); ?>
    <link href="https://fonts.googleapis.com/css2?family=Italiana&family=Montserrat:ital,wght@0,300;0,600;1,400&display=swap" rel="stylesheet"
</head>
<body>
    <header>
    <div class="container">
        <div class="row">
            <div class="logo">
                <a href="<?php echo home_url();?>">
                    <?php
                        $logo = get_theme_mod( 'custom_logo' );
                        $image = wp_get_attachment_image_src( $logo , 'full' );
                    ?>
                    <img src="<?php echo $image[0];?>" alt="logo" width="87" height="32">
                </a>
            </div>
            <div>
                <?php wp_nav_menu([
                    'theme_location' => 'menu',
                    'container'            => false,
                    'menu_class'           => 'menu',
                ]);?>
            </div>
        </div>
    </div>
</header>
