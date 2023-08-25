<?php
function Pagination($number, $page){
	
	if ($number > 1){
		echo '<ul class="prod-page-box">';			
		if($page>1){
			echo '<li class="prod-page-item"><div class="page-link" onclick="pageClickPagination('.($page-1).')">Previous</div></li>';
		}

		$avaiablePage = [1,$page-1,$page,$page+1,$number]; //mảng gồm trang đầu, trang cuối, trang hiện tại và 2 trang kế trang hiện tại 
		$isFirst = $isLast = false; // 2 biến này để kiếm tra có dấu ... trước và sau trang hiện tại chưa
		for($i=0; $i<$number; $i++){
			if(!in_array($i+1,$avaiablePage)){ //nếu không có trong mảng thì ra khỏi vòng for
				if(!$isFirst && $page >3){//nếu chưa có dấu ... và số trang phải lớn hơn 3
					echo'<li class="prod-page-item"><div class="page-link" onclick="pageClickPagination('.($page-2).')">...</div></li>';
					$isFirst = true; //xác nhận đã có dấu ...
				}
				if(!$isLast && $i >$page){
					echo'<li class="page-item"><div class="page-link" onclick="pageClickPagination('.($page+2).')" >...</div></li>';
					$isLast = true; //xác nhận đã có dấu ...
				}
				continue;
			}
			if($page==$i+1){
				echo'<li class="prod-page-item active">
                <div class="page-link">'.($i+1).'</div>
                </li>';
			}else{
				echo'<li class="prod-page-item">
                <div class="page-link" onclick="pageClickPagination('.($i+1).')">'.($i+1).'</div>
                </li>';
			}		
		}
		if($page<$number){
			echo '<li class="prod-page-item">
            <div class="page-link" onclick="pageClickPagination('.($page+1).')">Next</div></li>';
		}	
	
	}
}

?>