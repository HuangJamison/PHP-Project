<?php
    require_once("test_pgdb.php");
    $cate = $_POST['cate'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $create_at = date("Y-m-d H:i:s");
    if (empty($cate) or empty($title) or empty($content) or empty($cate)){
?>
        <a href="cate_add.php"><input type="button" value="回上一頁"></a>
<?php    
            die("請重新確認分類名字是否為不為空!!");
    }
    $sql = "INSERT INTO posts (title,content,category_id,create_at) VALUES (?,?,?,?)";
    try{
        $sql = $conn->prepare($sql);
        if ($sql->execute(array($title,$content,$cate,$create_at))){
            header("Location: ./admin_post.php");
            // echo "執行成功";
        }else{
            throw new Exception("新增分類失敗");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
?>