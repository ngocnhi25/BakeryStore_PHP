<?php
require_once('../connect/connectDB.php');

$cates = executeResult("select * from tb_category");
// $row = executeSingleResult("select count(*) as total from tb_products where cate_id = ");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="category">
        <h1>Category</h1>
        <div>
            <table>
                <table>
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="" id=""> All
                            </th>
                            <th>Id</th>
                            <th>Category Name</th>
                            <th>Total Products</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cates as $key => $cate) { 
                            $row = executeSingleResult("select count(*) as total from tb_products where cate_id = $key");
                        ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="" id="">
                                </td>
                                <td><?= $key ?></td>
                                <td><?= $cate["cate_name"] ?></td>
                                <td><?php echo $row["total"] ?></td>
                                <td><button>Delete</button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </table>
        </div>
    </div>
</body>

</html>