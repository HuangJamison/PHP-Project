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
        <?php
            require_once("test_pgdb.php");
            $id = $_GET['id'];
            $sql = "SELECT P.title, P.create_at, P.content, C.name 
            FROM posts AS P LEFT JOIN categories AS C ON P.category_id = C.id WHERE P.id=?";
            try{
                $result = $conn->prepare($sql);
                if ($result->execute(array($id))){
                    $row = $result->fetchObject();
        ?>
        <div class="single_article">
            <div class="single__cate">
                <?php echo "[$row->name]"; ?>
            </div>
            <div class="single__title">
                <?php echo $row->title; ?>
            </div>
            <div class="single__time">
                <?php echo date('Y/m/d H:i:s',strtotime($row->create_at.'+6 hour')); ?>
            </div>
        </div>
        <div class="single__content">
            <?php echo $row->content; ?>
        </div>
        <?php
                }else{
                    throw new Exception("沒找到文章");
                }
            }catch(Exception $e){
                echo $e->getMessage();
            }

        ?>
    </div>
</body>
</html>