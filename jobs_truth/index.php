<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>友善版求職天眼通</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <?php
        $is_login = false;
        if(isset($_COOKIE['username']) && !empty($_COOKIE['username'])){
            $is_login = true;
            $username = $_COOKIE['username'];
        }
    ?>
    <div class="container">
        <div class="login_area">
            <?php
                if ($is_login){
                    echo "<a href='logout.php'>登出</a> ";
                    echo "<a href='../jobs_app/index.php'>新鮮人職缺平台</a> ";
                }else{
                    echo "<a href='register.php'>註冊</a> ";
                    echo "<a href='login.php'>登入</a> "; 
                    echo "<a href='../jobs_app/index.php'>新鮮人職缺平台</a> ";
                }
            ?>
        </div>
        <div class="title">
            Share your working or interview experience. We want to let market be transparent in management and labor.        
        </div>
        <div class="readytopic">
            <form method="POST" action="handle_add_article.php">
                <div class="ready__title">
                    <?php 
                        if ($is_login){
                            echo "<h2>Hi!" . $username . ",歡迎你分享資訊</h2>";
                        }else{
                            echo "<h2>訪客你好，請先註冊會員即可分享資訊哦!</h2>";
                        }
                    ?>
                </div>
                <input type="hidden" name="username" value="<?php echo $username;?>">
                <div class="ready__company">
                    <label for="company">公司名:</label><input name="company" type="text" id="company" placeholder="公司名..."/>
                </div>
                <div class="ready__good">
                    <label for="good">優點:</label><textarea rows="5" cols="12" name="good" id="good" placeholder="優點..."></textarea>
                </div>
                <div class="ready__bad">
                    <label for="bad">缺點:</label><textarea rows="5" cols="12" name="bad" id="bad"  placeholder="缺點..."></textarea>
                </div>
                <?php
                    // 寫一個不是會員 不能分享資訊
                    if($is_login){
                        echo "<div class='ready__btn'>";
                            echo "<input type='submit' value='送出'/>";
                        echo "</div>";
                    }else{
                        echo "<div class='ready__btn'>";
                        echo "<a href='login.php'><input type='button' value='請先登入哦!'/></a>";
                        echo "</div>";
                    }
                ?>
            </form>
        </div>
        <div class="topics__all">
            <?php
                // search articles
                require_once('conn_pgdb.php');
                $sql = "SELECT * FROM articles ORDER BY create_at DESC";
                $result = $conn->query($sql);
                try{
                    if($result->rowCount()>0){
                        while($row = $result->fetchObject()){
                            echo "<div class='topic' data-article_id=" . $row->id  . ">";
                                //文章處
                                echo "<div class='topic__author'>" . $row->username . "</div>";
                                echo "<div class='topic__time'>" . $row->create_at . "</div>";
                                if ($is_login && ($_COOKIE['username']===$row->username)){
                                    echo "<div class='topic__edit' data-article_id=" . $row->id  . ">修改內文</div>";
                                }else{
                                    //空
                                }
                                echo "<div class='topic__company'>公司:" . $row->company . "</div>";
                                echo "<div class='topic__good'>優點:" . $row->good . "</div>";
                                echo "<div class='topic__bad'>缺點:" . $row->bad . "</div>";
                            echo "</div>";
                        // 不要讓while在此結束，後面還要加上 comment 按鈕
                        // 留言按鈕
            ?>
              
            <?php
                // 留言所有內容
                require('msg_all.php'); // 重複使用 程式碼分離
            ?>

            <?php
                // 留言按鈕 
                require('msg_btn.php'); // 程式碼分離
            ?>
            <?php
                // while的後半段
                        }
                    }
                }catch(PDOException $e){
                    die("Error:" . $e->getMessage());
                }
            ?>

        </div>
    </div>
    <script src="all.js"></script>
</body>
</html>