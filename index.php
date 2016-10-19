<?php get_header(); ?>

<section class="social-media-example">
    <div class="container">
        <h3>Social Media Examples</h3>
        <hr/>
        <h4>Basic Square Media Social Icons</h4>
        <div class="social-media">
            <?php get_template_part('inc/modules/social', 'section'); ?>
        </div>

        <div class="clearfix"></div>

        <h4>Basic Circle Media Social Icons</h4>
        <div class="social-media media-circle">
            <?php get_template_part('inc/modules/social', 'section'); ?>
        </div>

        <div class="clearfix"></div>

        <h4>Basic Square Media Social Icons With Color</h4>
        <div class="social-media full-color">
            <?php get_template_part('inc/modules/social', 'section'); ?>
        </div>

        <div class="clearfix"></div>

        <h4>Basic Circle Media Social Icons With Color</h4>
        <div class="social-media full-color media-circle">
            <?php get_template_part('inc/modules/social', 'section'); ?>
        </div>
    </div>
</section>

<section id="appointment-section">
    <div class="container">
        <h3>Basic Parallax Using jQuery Jarallax</h3>
        <hr/>
        <div class="jarallax"
            style="background-image: url(<?php echo get_bloginfo('template_url'); ?>/assets/images/back.jpg);">
        </div>
    </div>
</section>

<section id="slider-section">
    <div class="container">
        <h3>Simple Carousel Slider Using Owl-carousel</h3>
        <hr/>
        <div id="owl-demo">
            <div class="item"><img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/owl1.jpg" alt="Owl Image"></div>
            <div class="item"><img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/owl2.jpg" alt="Owl Image"></div>
            <div class="item"><img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/owl3.jpg" alt="Owl Image"></div>
            <div class="item"><img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/owl4.jpg" alt="Owl Image"></div>
            <div class="item"><img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/owl5.jpg" alt="Owl Image"></div>
            <div class="item"><img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/owl6.jpg" alt="Owl Image"></div>
            <div class="item"><img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/owl7.jpg" alt="Owl Image"></div>
            <div class="item"><img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/owl8.jpg" alt="Owl Image"></div>
        </div>

        <h3>Simple Slider Using Owl-carousel</h3>
        <hr/>
        <div id="owl-demo-1" class="owl-carousel owl-theme">

            <div class="item"><img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/fullimage1.jpg" alt="The Last of us"></div>
            <div class="item"><img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/fullimage2.jpg" alt="GTA V"></div>
            <div class="item"><img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/fullimage3.jpg" alt="Mirror Edge"></div>

        </div>

        <h3><a href="http://kenwheeler.github.io/slick/" target="_blank">Slick Usage</a></h3>
        <hr/>
        <div class="slick-slider">
            <div class="item"><img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/fullimage1.jpg" alt="The Last of us"></div>
            <div class="item"><img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/fullimage2.jpg" alt="GTA V"></div>
            <div class="item"><img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/fullimage3.jpg" alt="Mirror Edge"></div>
        </div>
    </div>
</section>

<section id="theme-shortcode">
    <div class="container">
        <h3>Test Theme Shortcode</h3>
        <hr/>
        <ul>
            <li>[ShopName] - <?php echo do_shortcode('ShopName'); ?></li>
            <li>[ShopOwner] - <?php echo do_shortcode('ShopOwner'); ?></li>
            <li>[ShopYear] - <?php echo do_shortcode('ShopYear'); ?></li>
            <li>[ShopStreet] - <?php echo do_shortcode('ShopStreet'); ?></li>
            <li>[ShopCity] - <?php echo do_shortcode('ShopCity'); ?></li>
            <li>[ShopST] - <?php echo do_shortcode('ShopST'); ?></li>
            <li>[ShopState] - <?php echo do_shortcode('ShopState'); ?></li>
            <li>[ShopZip] - <?php echo do_shortcode('ShopZip'); ?></li>
            <li>[ShopAddress] - <?php echo do_shortcode('ShopAddress'); ?></li>
            <li>[ShopEmail] - <?php echo do_shortcode('ShopEmail'); ?></li>
            <li>[ShopPhone] - <?php echo do_shortcode('ShopPhone'); ?></li>
            <li>[ShopFax] - <?php echo do_shortcode('ShopFax'); ?></li>
            <li>[ShopWebsite] - <?php echo do_shortcode('ShopWebsite'); ?></li>
        </ul>
    </div>
</section>

<section id="map">
    <div class="container">
        <h3>Multiple Locations</h3>
        <hr/>
    </div>
    <?php if( have_rows('google_map_locations', 'option') ): ?>
        <?php while ( have_rows('google_map_locations', 'option') ) : the_row();
            $location = get_sub_field('location', 'option');
            $title = get_sub_field('title', 'option');
        ?>
            <div class="map-address">
                <i class="fa fa-map-marker"></i>&nbsp;
                <?php echo $title; ?>&nbsp;-&nbsp;
                <?php echo $location['address']; ?>
                <br/>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>

    <?php if( have_rows('google_map_locations', 'option') ): ?>
        <div class="acf-map">
            <?php while ( have_rows('google_map_locations', 'option') ) : the_row();
                $location = get_sub_field('location', 'option');
                $title = get_sub_field('title', 'option');
            ?>
                <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
                    <h4><?php echo $title; ?></h4>
                    <p class="address"><?php echo $location['address']; ?></p>
                </div>
        <?php endwhile; ?>
        </div>
    <?php endif; ?>
</section>

<?php get_footer(); ?>
