<?php

$query = new WP_Query(array(
	'post_type' => 'members',
	'nopaging' => true
));

if($query->have_posts()):
	while($query->have_posts()):
		$query->the_post();?>
		<div class="member__item text-center text-md-start d-block d-md-flex">
			<img alt="Member thumbnail" class="member__item__thumbnail" src="<?php echo get_the_post_thumbnail_url() ?>">
			<div class="member__item__content">
				<h2><?php echo get_the_title() ?></h2>
				<p><?php echo get_the_content() ?></p>
			</div>
			<div class="member__item__social-icons d-none d-md-block">
				<?php if(!empty(get_field('youtube'))):?>
					<a href="<?php echo get_field('youtube') ?>" target="_blank"><img alt="social media Youtube icon" class="member__item__social-icons__icon" src="<?php echo wp_get_attachment_image_src(203)[0] ?>"></a>
				<?php endif;?>
				<?php if(!empty(get_field('twitch'))):?>
					<a href="<?php echo get_field('twitch') ?>" target="_blank"><img alt="social media Twitch icon" class="member__item__social-icons__icon" src="<?php echo wp_get_attachment_image_src(204)[0] ?>"></a>
				<?php endif;?>
				<?php if(!empty(get_field('instagram'))):?>
					<a href="<?php echo get_field('instagram') ?>" target="_blank"><img alt="social media Instagram icon" class="member__item__social-icons__icon" src="<?php echo wp_get_attachment_image_src(205)[0] ?>"></a>
				<?php endif;?>
				<?php if(!empty(get_field('twitter'))):?>
					<a href="<?php echo get_field('twitter') ?>" target="_blank"><img alt="social media Twitter icon" class="member__item__social-icons__icon" src="<?php echo wp_get_attachment_image_src(206)[0] ?>"></a>
				<?php endif;?>
			</div>
		</div>
	<?php
	endwhile;
endif;