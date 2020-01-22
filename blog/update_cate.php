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
        $sql = "SELECT * FROM categories WHERE id= ?";
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
                編輯分類
            </div>
            <div class="btn_area">
                <a href="admin_cate.php"><input type="button" value="回到管理分類頁面"/></a>
            </div>
            <form class="add_cate_form" action="handle_cate_update.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row->id ?>"/>
                <div class="cate__title">
                    <label for="name">名稱: </label><input type="text" name="name" id="name" value="<?php echo $row->name; ?>"/>
                </div>
                <div class="form__submit">
                    <input type="submit" value="送出"/>
                </div>
            </form>
        </div>
    </div>
</body>
</html>