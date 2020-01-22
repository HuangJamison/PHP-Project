<?php
    require_once("test_pgdb.php");
    $id = $_GET['id'];
    $sql = "DELETE FROM posts WHERE id=?";
    $sql = $conn->prepare($sql);
    try{
        if ($sql->execute(array($id))){
            header("Location: ./admin_post.php");
        }else{
            throw new Exception("刪除失敗");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }

?>