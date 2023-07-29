<?php 

function calculatePercentPrice($price, $percent){
    return ($price * (100 - $percent) / 100);
}

?>