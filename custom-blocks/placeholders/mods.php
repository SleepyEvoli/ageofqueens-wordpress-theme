<?php
$query = new WP_Query(array(
	'post_type' => 'mods',
	'nopaging' => true
));

if($query->have_posts()):
	while($query->have_posts()):
		$query->the_post();?>
		<div class="mod__item clickable" onclick="window.open('<?php echo get_field('url') ?>')">
			<img src="<?php echo get_the_post_thumbnail_url(); ?>"/>
			<div class="mod__item__content">
				<span class="mod__item__content__heading"><?php echo get_the_title() ?> - <?php echo get_field('author') ?></span>
				<p><?php echo get_field('categories') ?></p>
				<p><?php echo get_the_content() ?></p>
			</div>
		</div>
	<?php
	endwhile;
endif;