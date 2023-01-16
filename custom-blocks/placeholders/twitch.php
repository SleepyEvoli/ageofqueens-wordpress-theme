<?php

include(dirname(__FILE__).'/../../inc/twitchLoader.php');
$twitchLoader = new TwitchLoader();

print_r($twitchLoader->twitchTeam->members);
