<?php

include(dirname(__FILE__).'/../../inc/cookieConsent.php');

if(isYesCookieConsentGiven()):
    ?>
	<a class="twitter-timeline" data-width="400" data-height="800"  href="https://twitter.com/AgeofQueens_aoe?ref_src=twsrc%5Etfw">Tweets by AgeofQueens_aoe</a>
	<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<?php endif ?>