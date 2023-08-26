<?php
require_once('../../connect/connectDB.php');
require_once('../../handles_page/handle_calculate.php');

$products = executeResult("select * from tb_news p
                            inner join tb_category c 
                            on p.new_cate_id = c.cate_id
                            ORDER BY new_id DESC");
$allProduct = executeSingleResult("select count(*) as total from tb_news");

?>

<div class="products">
    <h1>News Page</h1>
    <div>
        <div class="total-items">
            <p>News All: <span><?= $allProduct["total"] ?></span></p>
            <p>News Delete: <span>25</span></p>
        </div>
    </div>
    <div class="table_box">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>News Title</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $key => $product) { ?>
                    <tr <?php echo (($product["deleted"] == 1) ? 'style="opacity: 0.5;"' : '') ?>>
                        <td><?= $key + 1 ?></td>
                        <td><?= $product["new_title"] ?></td>
                        <td>
                            <img src="../../<?= $product["new_image"] ?>" alt="" style="width: 130px; border-radius: 8px;">
                        </td>
                        <td><?= $product["cate_name"] ?></td>
                        <td class="button">
                            <button id="editNew" onclick='editNew(<?= $product["new_id"] ?>)' type="button" class="update">Update</button>
                            <?php if ($product["deleted"] == 0) { ?>
                                <button type="button" onclick='deleteNew(<?= $product["new_title"],$product["new_id"] ?>)' class="delete">Delete</button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../../public/backend/js/news.js"></script>
