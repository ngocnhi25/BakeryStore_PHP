<?php
session_start();
require_once("../connect/connectDB.php");
date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d H:i:s');
$vote = '';

if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
    if (isset($_POST["comment_id"])) {
        $comment_id = $_POST["comment_id"];
        $action = $_POST["action"];
        $vote = ($action == "like") ? 1 : 0;

        $checkVoted = checkRowTable("SELECT * FROM tb_like_comments 
                                    WHERE user_id = $user_id 
                                    and comment_id = $comment_id");
                                    
        if ($checkVoted == 0) { 
            $success = execute("INSERT INTO tb_like_comments 
            (user_id, comment_id, vote, vote_date) 
            VALUES ($user_id, $comment_id, $vote, '$date')");
        } else {
            $checkLike = checkRowTable("SELECT * FROM tb_like_comments WHERE user_id = $user_id AND comment_id = $comment_id AND vote = 1");
            $checkUnlike = checkRowTable("SELECT * FROM tb_like_comments WHERE user_id = $user_id AND comment_id = $comment_id AND vote = 0");

            if ($action == "like" && $checkLike == 0) {
                $success = execute("UPDATE tb_like_comments SET vote = $vote, vote_date = '$date' WHERE user_id = $user_id AND comment_id = $comment_id");
            } elseif ($action == "unlike" && $checkUnlike == 0) {
                $success = execute("UPDATE tb_like_comments SET vote = $vote, vote_date = '$date' WHERE user_id = $user_id AND comment_id = $comment_id");
            } else {
                $success = execute("DELETE FROM tb_like_comments WHERE user_id = $user_id AND comment_id = $comment_id");
            }
        }

        if ($success) {
            $qtyVoteLike = executeSingleResult("SELECT COUNT(*) as total FROM tb_like_comments 
            WHERE comment_id = $comment_id and vote = 1");
            $qtyVoteUnlike = executeSingleResult("SELECT COUNT(*) as total FROM tb_like_comments 
            WHERE comment_id = $comment_id and vote = 0");
            $response = [
                'like' => $qtyVoteLike["total"],
                'unlike' => $qtyVoteUnlike["total"]
            ];
            echo json_encode($response);
        }
    }
} else {
    echo "notLoggedIn";
}
