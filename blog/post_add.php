<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新增文章</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <?php
        require_once("test_pgdb.php");
        $sql = "SELECT * FROM categories ORDER BY create_at DESC";
        $result = $conn->query($sql); // 先放入
        if ($result->rowCount()>0){
    ?>
    <div class="container">
        <div class="form_container">
            <div class="title">
            新增文章
            </div>
            <div class="btn_area">
                <a href="admin_post.php"><input type="button" value="回到文章管理頁面"/></a>
            </div>
            <form class="post_add_form" action="handle_post_add.php" method="POST">
                <div class="form__title">
                    <label for="title">標題: </label><input type="text" name="title" id="title"/>
                </div>
                <div class="form__content">
                    <label for="content">內文: </label><textarea rows="20" cols="100" id="content" name="content"></textarea>
                </div>
                <div class="form__cate">
                    <label for="cate">分類:</label>
                    <select name="cate" id="cate">
                        <?php
                                while( $row = $result->fetchObject() ){
                                    echo "<option value='$row->id'>" . $row->name . "</option>"; 
                                }
                            } // if 下引號
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