<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Blog Posts Admin</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <div class="container">
        <div class="cates">
            <div class="btn_area">
                <a href="post_add.php"><input type="button" value="新增文章"/></a>
                <a href="admin_cate.php"><input type="button" value="分類管理頁面"/></a>
                <a href="index.php"><input type="button" value="返回前端頁面"/></a>
            </div>
            <ul class="post_admin">
                <?php
                    require_once("test_pgdb.php");
                    $sql = "SELECT * FROM posts ORDER BY create_at DESC";
                    $result = $conn->query($sql); // 先放入
                    try {
                         if ($result->rowCount()>0){
                           while( $row = $result->fetchObject() ){
                ?>
                                <li data-cate_id="<?php echo $row->id; ?>"><?php echo $row->title;?>
                                    <span>
                                        <?php 
                                            $cate_id = $row->category_id;
                                            require_once("test_pgdb.php");
                                            $cate_sql = "SELECT * FROM categories WHERE id=$cate_id";
                                            $cate_sql = $conn->query($cate_sql);
                                            $row_cate = $cate_sql->fetchObject();
                                            echo "[$row_cate->name]";
                                        ?>
                                    </span> 
                                    <a href="<?php echo 'update_post.php?id=' . $row->id ; ?>">更新文章</a> 
                                    <a href="<?php echo 'handle_post_delete.php?id=' . $row->id ; ?>">刪除文章</a> 
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