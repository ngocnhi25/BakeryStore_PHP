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

function formatElapsedTime($time)
{
    date_default_timezone_set('Asia/Bangkok');
    $currentTimestamp = time();
    $userActivityTimestamp = strtotime($time);
    $elapsedTime = $currentTimestamp - $userActivityTimestamp;

    if ($elapsedTime < 60) {
        return "just finished";
    } elseif ($elapsedTime < 3600) {
        $minutes = floor($elapsedTime / 60);
        return "$minutes minutes";
    } elseif ($elapsedTime < 86400) {
        $hours = floor($elapsedTime / 3600);
        $minutes = floor(($elapsedTime % 3600) / 60);
        return "$hours hours";
    } else {
        $days = floor($elapsedTime / 86400);
        if($days > 10){
            return $time;
        } else {
            return "$days days";
        }
    }
}

function countLikeComments($comment_id) {
    $count = executeSingleResult("SELECT count(*) as count FROM tb_like_comments where comment_id = $comment_id and vote = 1");
    if($count){
        return $count["count"];
    } else {
        return 0;
    }
}

function countUnlikeComments($comment_id) {
    $count = executeSingleResult("SELECT count(*) as count FROM tb_like_comments where comment_id = $comment_id and vote = 0");
    if($count){
        return $count["count"];
    } else {
        return 0;
    }
}

function checkVotedLike($user_id, $comment_id){
    if($user_id == ''){
        return false;
    } else {
        $checkVoted = checkRowTable("SELECT * FROM tb_like_comments 
        WHERE user_id = $user_id and comment_id = $comment_id and vote = 1");
        if($checkVoted != null){
            return "active";
        } else {
            return false;
        }
    }
}
function checkVotedUnlike($user_id, $comment_id){
    if($user_id == ''){
        return false;
    } else {
        $checkVoted = checkRowTable("SELECT * FROM tb_like_comments 
        WHERE user_id = $user_id and comment_id = $comment_id and vote = 0");
        if($checkVoted != null){
            return "active";
        } else {
            return false;
        }
    }
}
