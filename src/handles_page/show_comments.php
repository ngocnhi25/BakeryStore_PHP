<?php
require_once("../connect/connectDB.php");
$commentHTML = '';
if(isset($_POST["product_id"])){
    $product_id = $_POST["product_id"];
    $commentsResult = executeResult("SELECT * FROM tb_comments c 
                                    INNER JOIN tb_user u ON c.user_id = u.user_id
                                    WHERE c.product_id = $product_id ORDER BY c.comment_id DESC");
    
    foreach($commentsResult as $c){
        echo "<ul class='commentList-lv1'>";
        echo "<li class='comment-lv1'>";
        echo "<h5> Username : ".$c["username"]." </h5>";
        echo "<div> ".$c["content"]." </div>";
        echo "<div class='feedback-btn'>";
        echo "<div class='feedback-btn'>";
        echo "<small class='reply'> Reply </small> <small>".$c["inbox_date"]."</small>";
        echo "</div>";
        echo "</div>";
        echo "<ul class='commentList-lv2'>";
            getCommentReply($c["comment_id"], $c["username"]);
        echo "</ul>";
        echo "</li>";
        echo "</ul>";
    }
}

function getCommentReply($comment_id, $user_name_parent) {
	$commentsResult = executeResult("SELECT * FROM tb_reply_comments rc
                                        INNER JOIN tb_user u ON rc.user_id = u.user_id
                                        where rc.comment_id = $comment_id");
    foreach($commentsResult as $c){
        echo "<li class='comment-lv2'>";
        echo "<h5> Username : ".$c["username"]." </h5>";
        echo "<div> @".$user_name_parent." ".$c["content"]." </div>";
        echo "<div class='feedback-btn'>";
        echo "<small class='reply'> Reply </small> <small>".$c["inbox_date"]."</small>";
        echo "</div>";
        echo "</li>";
    }
}
