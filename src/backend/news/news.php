<?php
require_once('../../connect/connectDB.php');
require_once('../../handles_page/handle_calculate.php');

$products = executeResult("SELECT * from tb_news p
                            inner join tb_news_cate c 
                            on p.new_cate_id = c.new_cate_id
                            ORDER BY new_id DESC");
// $allProduct = executeSingleResult("select count(*) as total from tb_news");
$cates = executeResult("SELECT * FROM tb_news_cate c INNER JOIN tb_news p ON c.new_cate_id = p.new_cate_id GROUP BY c.new_cate_id");

?>

<div class="products">
    <h1>News Management</h1>
    <div class="filter-product">
        <div class="form-search-header">
            <span class="material-symbols-sharp icon">search</span>
            <input id="filter-search-product" type="text" name="search" placeholder="Search news..." class="form-control">
        </div>
        <div class="filter-product-box">
            
            <div class="select-container">
                <select name="category" class="select-box" id="cateSearch">
                    <option value="">__All Category__</option>
                    <?php foreach ($cates as $key => $c) { ?>
                        <option value="<?= $c["new_cate_id"] ?>"><?= $c["new_cate_name"] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="select-container">
                <select name="category" class="select-box" id="arrangeProduct">
                    <option value="new_to_old">New to old</option>
                    <option value="old_to_new">Old to new</option>
                    
                    <!-- <option value="product_qty">News quantity</option> -->
                </select>
            </div>
        </div>
    </div>
    <div id="container_table_product"></div>
</div>

<script src="../../public/backend/js/news.js"></script>
