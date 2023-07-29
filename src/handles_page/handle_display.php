<?php 

function displayPrice($price){
    echo (number_format((float) str_replace([' VNĐ', ','], '', $price), 0, ',', '.'));
}

?>