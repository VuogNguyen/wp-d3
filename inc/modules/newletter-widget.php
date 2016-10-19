<div class="newletter-wrapper">
	<h4><?php echo get_field('newletter_title', 'option'); ?></h4>
	<div class="newletter-form-wrapper">
		<?php echo do_shortcode( '[gravityform id='. get_field('newletter_form_id', 'option') .' title=false description=false ajax=true tabindex=49]' ); ?>
	</div>
</div>