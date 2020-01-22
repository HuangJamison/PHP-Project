<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Blog Categories Admin</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <div class="container">
        <div class="cates">
            <div class="btn_area">
                <a href="cate_add.php"><input type="button" value="新增分類"/></a>
                <a href="admin_post.php"><input type="button" value="文章管理頁面"/></a>
                <a href="index.php"><input type="button" value="返回前端頁面"/></a>
            </div>
            <ul class="cate_admin">
                <?php
                    require_once("test_pgdb.php");
                    $sql = "SELECT * FROM categories ORDER BY create_at DESC";
                    $result = $conn->query($sql); // 先放入
                    try {
                         if ($result->rowCount()>0){
                           while( $row = $result->fetchObject() ){
                ?>
                                <li data-cate_id="<?php echo $row->id; ?>"><?php echo $row->name;?> 
                                    <a href="<?php echo 'update_cate.php?id=' . $row->id ; ?>">更新分類</a> 
                                    <a href="<?php echo 'handle_cate_delete.php?id=' . $row->id ; ?>">刪除分類</a> 
                                </li>
                <?php
                           }
                         }else{
                            throw new Exception("no row appear!");
                         }
                    } catch(Exception $e){

                    }
                ?>
            </ul>
        </div>
    </div>
</body>
</html>