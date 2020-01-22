<?php
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['cate'];
    $create_at = date("Y-m-d H:i:s");
    require_once("test_pgdb.php");
    $sql = "UPDATE posts SET title = ?, content = ? , category_id = ?, create_at = ? WHERE id = ?";
    $sql = $conn->prepare($sql);
    try{
        $sql->execute(array($title,$content,$category_id,$create_at,$id));
        header("Location: ./admin_post.php");
    }catch(Exception $e){
        echo $e->getMessage();
    }
?>