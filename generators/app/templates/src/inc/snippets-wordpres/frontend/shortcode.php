<?php

// validar shortcode

<?php if ( shortcode_exists( 'elfsight_instagram_feed' ) ): ?>
	content Here!
	<?php echo do_shortcode( '[elfsight_instagram_feed id="1"]' ); ?>
<?php endif; ?>
