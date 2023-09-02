<?php
session_start();
require_once("../connect/connectDB.php");
require_once("handle_calculate.php");
if (isset($_POST["product_id"])) {
    $user_id = '';
    if (isset($_SESSION["auth_user"])) {
        $user_id = $_SESSION["auth_user"]["user_id"];
    }

    $product_id = $_POST["product_id"];

    function getCommentReply($parent_id, $reply_id, $userReply)
    {
        global $product_id, $user_id;
        $orderBy = ($reply_id === 0) ? "DESC" : "ASC";
        $commentsResult = executeResult("SELECT * FROM tb_comments c 
                                    INNER JOIN tb_user u ON c.user_id = u.user_id
                                    WHERE c.product_id = $product_id 
                                    and c.parent_id = $parent_id and c.reply_id = $reply_id 
                                    ORDER BY c.comment_id $orderBy");
        foreach ($commentsResult as $c) {
            $comment_reply = $reply_id === 0 ? $c["comment_id"] : $reply_id;

            echo "<div class='comment comment-lv" . $c["parent_id"] . "'>";
            echo "<div class='commentList'>";
            echo "<div class='content-comment'>";
            echo "<span class='user-comment'>@" . $c["username"] . "</span>";
            echo "<p><span class='user-comment'>" . $userReply . " </span>" . $c["content"] . "</p>";
            echo "</div>";
            echo "<div class='reply-comment'>";
            echo "<div class='date-comment'>" . formatElapsedTime($c["inbox_date"]) . "</div>";
            echo "<div class='vote-comment btn-like ".checkVotedLike($user_id, $c["comment_id"])."' data-id='" . $c["comment_id"] . "'>";
            echo "<span class='material-icons'>thumb_up</span>";
            echo "<span>" . countLikeComments($c["comment_id"]) . "</span>";
            echo "</div>";
            echo "<div class='vote-comment btn-unlike ".checkVotedUnlike($user_id, $c["comment_id"])."' data-id='" . $c["comment_id"] . "'>";
            echo "<span class='material-icons'>thumb_down</span>";
            echo "<span>" . countUnlikeComments($c["comment_id"]) . "</span>";
            echo "</div>";
            echo "<div class='btn-reply btn-reply" . $c["parent_id"] . "'>";
            echo "<span>Reply</span>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<div class='input-reply-lv" . $c["parent_id"] . "' data-reply='" . $comment_reply . "'>";
            echo "</div>";
            echo "</div>";
            getCommentReply($c["parent_id"] + 1, $c["comment_id"], $c["username"]);
        }
    }
    getCommentReply(1, 0, '');
}
