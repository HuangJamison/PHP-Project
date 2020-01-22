<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update categories</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <?php
        // 先載入資料庫
        require_once('test_pgdb.php');
        $id = $_GET['id'];
        $sql = "SELECT * FROM posts WHERE id= ?";
        $result = $conn->prepare($sql);
        $result->execute(array($id));
        if($result->rowCount()>0){
            $row = $result->fetchObject();
        }else{
            echo $conn->error;
            die("Error!! Can not take this data.");
        }
    ?>
    <div class="container">
        <div class="form_container">
            <div class="title">
                編輯文章
            </div>
            <div class="btn_area">
                <a href="admin_post.php"><input type="button" value="回到管理文章頁面"/></a>
            </div>
            <form class="add_post_form" action="handle_post_update.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row->id ?>"/>
                <div class="post__title">
                    <label for="title">名稱: </label><input type="text" name="title" id="title" value="<?php echo $row->title; ?>"/>
                </div>
                <div class="post__content">
                   <label for="content">內文: </label><textarea rows="20" cols="100" id="content" name="content"><?php echo $row->content; ?></textarea>
                </div>
                <div class="post__cate">
                    <label for="cate">分類:</label>
                    <select name="cate" id="cate">
                        <?php
                            require_once("test_pgdb.php");
                            $sql_cate = "SELECT * FROM categories ORDER BY create_at DESC";
                            $result_cate = $conn->query($sql_cate); // 先放入
                            if ($result_cate->rowCount()>0){
                                while( $row_cate = $result_cate->fetchObject() ){
                                    // 判斷是否為選取之分類 三元運算子
                                    $str = ($row_cate->id === $row->category_id) ? "selected":"";
                                    echo "<option value='$row_cate->id' $str>" . $row_cate->name . "</option>"; 
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form__submit">
                    <input type="submit" value="送出"/>
                </div>
            </form>
        </div>
    </div>
</body>
</html>