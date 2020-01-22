<?php
    require_once("test_pgdb.php");
    $id = $_GET['id'];
    $sql = "DELETE FROM categories WHERE id=?";
    $sql = $conn->prepare($sql);
    try{
        if ($sql->execute(array($id))){
            header("Location: ./admin_cate.php");
        }else{
            throw new Exception("刪除失敗");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
?>