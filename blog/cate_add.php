<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新增分類</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <div class="container">
        <div class="form_container">
            <div class="title">
            新增分類
            </div>
            <div class="btn_area">
                <a href="admin_cate.php"><input type="button" value="回到分類管理頁面"/></a>
            </div>
            <form class="cate_add_form" action="handle_cate_add.php" method="POST">
                <div class="form__title">
                    <label for="title">名稱: </label><input type="text" name="cate" id="cate"/>
                </div>
                <div class="form__submit">
                    <input type="submit" value="送出"/>
                </div>
            </form>
        </div>
    </div>
</body>
</html>