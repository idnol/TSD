<?php
get_header();


$posts = get_posts([
    'numberposts' => -1,
    'post_type' => 'slides',
    'post_status' => 'publish',
]);

?>
<div class="content-area">
    <?php the_content();?>
</div>
<?php if ($posts):?>
<section class="section-slider">
    <div class="container">
        <div class="row">
            <div class="block-title">
                <h2>
                    <?php
                    $value = get_field( "title_slider_black" );
                    echo $value;
                    ?>
                    <span>
                        <?php
                        $value = get_field( "title_slider_green" );
                        echo ' '.$value;
                        ?>
                    </span>
                </h2>
                <div class="d-flex">
                    <div class="arrow prev">
                        <svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.7709 4.44711C19.7706 4.44687 19.7704 4.4466 19.7702 4.44636L15.688 0.383869C15.3821 0.0795337 14.8875 0.0806662 14.5831 0.386525C14.2787 0.692345 14.2799 1.18699 14.5857 1.49137L17.3265 4.21886H0.78125C0.349766 4.21886 0 4.56863 0 5.00011C0 5.4316 0.349766 5.78136 0.78125 5.78136H17.3264L14.5857 8.50886C14.2799 8.81323 14.2788 9.30788 14.5831 9.6137C14.8875 9.9196 15.3822 9.92065 15.688 9.61636L19.7702 5.55386C19.7704 5.55363 19.7706 5.55335 19.7709 5.55312C20.0769 5.24773 20.0759 4.75148 19.7709 4.44711Z" fill="white"/>
                        </svg>
                    </div>
                    <div class="arrow next" aria-disabled="true">
                        <svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.7709 4.44711C19.7706 4.44687 19.7704 4.4466 19.7702 4.44636L15.688 0.383869C15.3821 0.0795337 14.8875 0.0806662 14.5831 0.386525C14.2787 0.692345 14.2799 1.18699 14.5857 1.49137L17.3265 4.21886H0.78125C0.349766 4.21886 0 4.56863 0 5.00011C0 5.4316 0.349766 5.78136 0.78125 5.78136H17.3264L14.5857 8.50886C14.2799 8.81323 14.2788 9.30788 14.5831 9.6137C14.8875 9.9196 15.3822 9.92065 15.688 9.61636L19.7702 5.55386C19.7704 5.55363 19.7706 5.55335 19.7709 5.55312C20.0769 5.24773 20.0759 4.75148 19.7709 4.44711Z" fill="white"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php foreach ($posts as $post):?>
                <div class="swiper-slide">
                    <div class="video-box">
                        <?php
                        $video = get_field('video', $post->ID);
                        $attr = array(
                            'src' => $video['url'],
                            'poster' => $video['sizes']['large']
                        );
                        echo wp_video_shortcode($attr);
                        ?>
                    </div>
                    <div class="content">
                        <q>
                            <?php echo $post->post_content;?>
                        </q>
                        <span class="name">
                            <?php echo $post->post_title;?>
                        </span>
                        <span class="description"><?php echo $post->post_excerpt;?></span>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
        <div class="row bar">
            <span>01</span>
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
            <span>0<?php echo count($posts);?></span>
        </div>
    </div>
</section>
<?php endif;?>
<?php wp_reset_postdata();?>
<?php $ajax_nonce_mail = wp_create_nonce('mail');?>
<section class="section-contact">
    <div class="container">
        <div class="row">
            <div class="section-contact-block">
                <h2>
                    <?php
                    $value = get_field( "title" );
                    echo ' '.$value;
                    ?>
                </h2>
                <div class="contact-content">
                    <a href="mailto:<?php $value = get_field( "email" ); echo $value; ?>">
                        <?php
                        $value = get_field( "email" );
                        echo $value;
                        ?>
                    </a>
                    <span>
                        <?php
                        $value = get_field( "adress" );
                        echo $value;
                        ?>
                    </span>
                </div>
            </div>
            <div>
                <form method="post" id="mailer">
                    <div class="mailer-name">
                        <input type="text" placeholder="Name" name="name">
                        <div class="error">Enter your name</div>
                    </div>
                    <div class="mailer-email">
                        <input type="email" placeholder="Email" name="email">
                        <div class="error">Enter current email</div>
                    </div>
                    <div class="mailer-message">
                        <textarea name="message" cols="30" rows="10" placeholder="Write something..."></textarea>
                        <div class="error">Your message must be more than 20 characters</div>
                    </div>
                    <div class="contact-submit">
                        <input type="submit" class="btn" value="Submit Message">
                        <img src="<?php echo get_template_directory_uri();?>/img/Shape.svg" alt="send">
                    </div>
                    <div class="success-true">Email sent successfully</div>
                    <div class="success error">Email not sent, please try again later</div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
// mail form
document.addEventListener("DOMContentLoaded", function(event) {
    $('#mailer').on('submit', function (e) {
        e.preventDefault();

        let data = {
            action: 'send_message',
            security: '<?php echo $ajax_nonce_mail; ?>',
            fields: $(this).serialize()
        };

        let form = $('#mailer');

        $.ajax({
            url: '<?php echo admin_url("admin-ajax.php") ?>',
            type: 'POST',
            data: data ,
            beforeSend: function() {
                form.addClass('sending');
                form.find('.error').removeClass('active');
                form.find('.success-true').removeClass('active');
                form.find('.success.error').removeClass('active');
            },
            complete: function() {
                setTimeout(function () {
                    form.removeClass('sending');
                },500);
            },
            success: function( result ) {

                if(result.name === false){
                    form.find('.mailer-name .error').addClass('active');
                }

                if(result.email === false){
                    form.find('.mailer-email .error').addClass('active');
                }

                if(result.message === false){
                    form.find('.mailer-message .error').addClass('active');
                }

                if(result.success === true){
                    form.find('.success-true').addClass('active');
                    form.trigger('reset');
                }

                if(result.success === false){
                    form.find('.success.error').addClass('active');
                }

            }
        });

    });
});
</script>
<?php get_footer();?>


