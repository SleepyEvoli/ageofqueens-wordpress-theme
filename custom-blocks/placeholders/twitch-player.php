<?php

include(dirname(__FILE__).'/../../inc/cookieConsent.php');

if(isYesCookieConsentGiven()):
?>
<iframe
    src="https://player.twitch.tv/?channel=ageofqueens&parent=streamernews.example.com&muted=true"
    height="480"
    width="848"
    allowfullscreen>
</iframe>
<?php endif ?>