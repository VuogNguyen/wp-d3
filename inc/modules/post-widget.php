<?php
	$categories = get_the_category( get_the_id() );
?>
<div class="post-widget">
	<div class="banner-wrapper">
	    <?php the_post_thumbnail('medium'); ?>
	</div>
	<div class="one-post-inner">
	    <div class="title-wrapper">
	        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	        <?php  ?>
	        <span>
            <?php foreach ($categories as $category): ?>
                <a href="<?php echo esc_url( get_category_link( $category->term_id ) ) ?>"><?php echo esc_html( $category->name ) ?></a>
            <?php endforeach; ?> · <?php echo get_field( 'post_read_time', get_the_id() ) ?> MIN READ</span>
	    </div>
	    <div class="content-wrapper">
	        <p><?php echo limit_text( get_the_content(), 30); ?></p>
	    </div>
	</div>
</div>