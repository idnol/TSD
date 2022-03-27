<?php
/**
 * Template footer (footer.php)
 * @package WordPress
 */
?>
<footer>
    <div class="container">
        <div class="row">
            <a href="<?php echo home_url();?>">
                <?php
                    $logo = get_theme_mod( 'custom_logo' );
                    $image = wp_get_attachment_image_src( $logo , 'full' );
                ?>
                <img src="<?php echo $image[0];?>" alt="logo" width="180" height="40">
            </a>
            <?php
            if ( is_active_sidebar( 'custom-footer-widget' ) ) : ?>
                <div id="footer-widget-area" class="chw-widget-area widget-area" role="complementary">
                    <?php dynamic_sidebar( 'custom-footer-widget' ); ?>
                </div>
            <?php endif; ?>
            <span class="copy">Copyright © 2021 All right reserved</span>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
