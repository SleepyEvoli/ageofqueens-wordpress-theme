<?php

function isYesCookieConsentGiven($cookieName = "cookieyes-consent"){
    if(isset($_COOKIE[$cookieName])){
        $values = explode(',', $_COOKIE[$cookieName]);
        $consentArr = explode(':', $values[1]);
        $consentKeyValue = [$consentArr[0] => $consentArr[1]];
        if($consentKeyValue['consent'] == 'yes'){
            return true;
        } else {
            return false;
        }
    }
}
