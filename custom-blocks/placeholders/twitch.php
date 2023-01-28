<?php

include(dirname(__FILE__).'/../../inc/twitchLoader.php');
$twitchLoader = new TwitchLoader();

if(isset($twitchLoader->twitchTeam)):?>
	<div class="twitch-team__container">
		<img class="twitch-team__container__banner" src="<?php echo $twitchLoader->twitchTeam->bannerUrl ?? '' ?>" alt="Twitch team banner">
		<img class="twitch-team__container__thumbnail" src="<?php echo $twitchLoader->twitchTeam->thumbnailUrl ?? ''  ?>" alt="Twitch team thumbnail"/>
		<h1 class="twitch-team__container__name"><?php echo $twitchLoader->twitchTeam->teamDisplayName ?? '' ?></h1>
		<p class="twitch-team__container__info"><?php echo $twitchLoader->twitchTeam->info ?? '' ?></p>
	</div>

	<div class="twitch-team__members">
	<?php
	foreach ($twitchLoader->twitchTeam->members as $member):?>
		<div class="twitch-team__members__member">
			<a href="https://twitch.tv/<?php echo $member->login ?>"><img class="twitch-team__members__member__profile-image" src="<?php echo $member->profileImageUrl ?? '' ?>" alt=""/></a>
				<p class="twitch-team__members__member__name"><?php echo $member->displayName ?? '' ?></p>
		</div>
	<?php endforeach; ?>
	</div>
<?php endif ?>