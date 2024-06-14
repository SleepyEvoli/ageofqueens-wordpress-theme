<?php
function getPercent($currValue, $maxValue){
    if($currValue == 0) return 0;
    $div = $currValue / $maxValue;
    return intval(ceil($div * 100));
}