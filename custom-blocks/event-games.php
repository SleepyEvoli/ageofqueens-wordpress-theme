<?php

$eventName = $attributes['eventName'] ?? null;

if ($eventName == null or empty($eventName)) {
    return;
}

$args = array(
    'post_type'  => 'event-games',
    'meta_key'   => 'event_name',
    'meta_value' => $eventName
);

$query = new WP_Query($args);

while($query->have_posts()):
    $query->the_post(); ?>
    <div class="event-game">
	    <a href="<?php echo get_field('url') ?>" target="_blank">
		    <div class="event-game__icon">
			    <img src="/wp-content/themes/ageofqueenstheme/assets/images/twitch-icon-64x64.png" alt="Twitch icon">
		    </div>
	        <div class="event-game__date"><?php echo get_field('date') ?></div>
	        <div class="event-game__map"><?php echo get_field('map') ?></div>
	        <div class="event-game__match-score">
	            <div class="event-game__match-score__team"><?php echo get_field('team_1') ?></div>
	            <div class="event-game__match-score__points"><?php echo get_field('team_1_score') ?></div>
	            <div class="event-game__match-score__separator"> - </div>
	            <div class="event-game__match-score__points"><?php echo get_field('team_2_score') ?></div>
	            <div class="event-game__match-score__team"><?php echo get_field('team_2') ?></div>
	        </div>
		</a>
    </div>
    <?php
endwhile;