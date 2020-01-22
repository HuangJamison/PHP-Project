<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jamie's PHP Blog</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <div class="container">
        <nav>
            <a href="index.php">首頁</a>
            <a href="admin_cate.php">文章分類管理</a>
            <a href="admin_post.php">文章管理</a>
        </nav>
        <div class="articles">
            <?php
                require_once("test_pgdb.php");
                $sql = "SELECT P.id,P.title,P.create_at,C.name
                FROM posts AS P LEFT JOIN categories AS C ON P.category_id = C.id 
                ORDER BY P.create_at DESC";
                try{
                    $result = $conn->query($sql);
                    if ($result->rowCount()>0){
                        while($row = $result->fetchObject()){
                            echo "<div class='article'><a href='article.php?id=$row->id'>";
                                echo "<div class='article__cate'>[" . $row->name . "]</div>";
                                echo "<div class='article__title'>" . $row->title . "</div>";
                                echo "<div class='article__create_at'>" . 
                                date('Y/m/d H:i:s',strtotime($row->create_at.'+6 hour')) . "</div>";
                            echo "</a></div>";
                        }
                    }else{
                        throw new Exception("列數不大於0");
                    }
                }catch(Exception $e){
                    echo $e->getMessage();
                }
            ?>

        </div>
    </div>
</body>
</html>