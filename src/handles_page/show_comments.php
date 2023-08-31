<?php
require_once("../connect/connectDB.php");
$commentHTML = '';
if(isset($_POST["product_id"])){
    $product_id = $_POST["product_id"];
    $commentsResult = executeResult("SELECT * FROM tb_comments c 
                                    INNER JOIN tb_user u ON c.user_id = u.user_id
                                    WHERE c.product_id = $product_id ORDER BY c.comment_id DESC");
    
    foreach($commentsResult as $c){
        echo "<div class='comment comment-c1'>";
        echo "<div class='commentList'>";
        echo "<div class='content-comment'>";
        echo "<span class='user-comment'>@".$c["username"]."</span> ".$c["content"]."</div>";
        echo "<div class='reply-comment'>";
        echo "<div class='date-comment'>".$c["inbox_date"]."</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
}

// function getCommentReply($comment_id, $user_name_parent) {
// 	$commentsResult = executeResult("SELECT * FROM tb_reply_comments rc
//                                         INNER JOIN tb_user u ON rc.user_id = u.user_id
//                                         where rc.comment_id = $comment_id");
//     foreach($commentsResult as $c){
//         echo "<li class='comment-lv2'>";
//         echo "<h5> Username : ".$c["username"]." </h5>";
//         echo "<div> @".$user_name_parent." ".$c["content"]." </div>";
//         echo "<div class='feedback-btn'>";
//         echo "<small class='reply'> Reply </small> <small>".$c["inbox_date"]."</small>";
//         echo "</div>";
//         echo "</li>";
//     }
// }
