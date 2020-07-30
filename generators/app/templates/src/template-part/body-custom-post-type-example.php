<?php

$args = array(
	'numberposts'	=> 4, // -1 is for all
	'post_type'		=> MyCustomPost::$post_type_name, // or 'post', 'page'
	'orderby' 		=> 'date', // or 'date', 'rand'
	'order' 		=> 'DESC', // or 'DESC'
	'post_status'	=>' publish',
);

// Get the posts
$myposts = get_posts($args);

?>
<?php if (is_array($myposts) && count($myposts) > 0): ?>
	<section class="section_artist_container">
		<div class="container" data-aos="fade-up" data-aos-duration="400">
			<div class="element_home--title">
				<h2><?php _e('ARTISTAS', '<%= name %>-theme'); ?></h2>
			</div>
			<div class="section_artist_container--list">
				<?php foreach ($myposts as $key => $post): ?>
					<?php setup_postdata($thepost); ?>
					<?php
						// thepost
						$URLThumbnail = get_the_post_thumbnail_url( $post->ID, 'thumbnail_480');
					?>
					<div class="section_artist_container--list_items" style="background-image: url('<?php echo $URLThumbnail ?>');">
						<div class="section_artist_container--list_items-artist">
							<div class="section_artist_container--list_items-artist-title">
								<h3><?php echo get_the_title(); ?></h3>
							</div>
							<div class="section_artist_container--list_items-artist-bio">
								<p><?php echo get_the_excerpt(); ?></p>
							</div>
							<div class="section_artist_container--list_items-artist-link">
								<a href="<?php echo get_permalink() ?>">
									<div class="button-square-icon"></div>
									<p><?php _e('CONÓCELO', '<%= name %>-theme'); ?></p>
								</a>
							</div>
						</div>
						<div class="section_artist_container--list_items-greyscale" style="background-image: url('<?php echo $URLThumbnail ?>');">
						</div>
					</div>
					<?php wp_reset_postdata(); ?>
				<?php endforeach; ?>
			</div>
			<div class="section_artist_container--divider">
				<a href="<?php echo get_post_type_archive_link(MyCustomPost::$post_type_name); ?>">
					<div class="button-square-icon"></div>
					<p><?php _e('VER TODOS LOS ARTISTAS', '<%= name %>-theme'); ?></p>
				</a>
			</div>
		</div>
		<div class="divider-home"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/general/raya1.svg" alt="divider"></div>
	</section>
<?php endif; ?>
