<div class="ageofqueens__card" style="background-color: <?php echo $attributes['backgroundColor'] ?? '#A9B1E417' ?>">
	<a href="<?php echo $attributes['linkUrl'] ?? "" ?>">
		<div class="ageofqueens__card__image">
			<img src="<?php echo $attributes['imgURL'] ?>" alt="Card Image">
		</div>
		<div class="ageofqueens__card__content"><?php echo $content ?></div>
	</a>
</div>
