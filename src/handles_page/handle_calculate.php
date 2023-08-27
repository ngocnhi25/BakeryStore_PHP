<?php
function displayPrice($price)
{
    return (number_format((float) str_replace([' VNĐ', ','], '', $price), 0, ',', '.'));
}

function calculatePercentPrice($price, $percent)
{
    $total = ($price * (100 - $percent) / 100);
    return displayPrice($total);
}

function calculatePercentPriceData($price, $percent)
{
    $total = ($price * (100 - $percent) / 100);
    return $total;
}

function calculateOldPrice($price, $percent)
{
    $total = ($price * 100 / (100 - $percent));
    return displayPrice($total);
}

function formatDate($date)
{
    $formattedDate = date("d/m/Y", strtotime($date));
    return $formattedDate;
}

function getMonthNow()
{
    $currentDate = new DateTime();

    $previousMonth = ltrim($currentDate->sub(new DateInterval('P1M'))->format('m'), '0');

    return $previousMonth;
}
