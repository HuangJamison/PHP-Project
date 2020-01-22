<?php
    require_once("test_pgdb.php");
    $id = $_POST['id'];
    $name = $_POST['name'];
    $create_at = date('Y-m-d H:i:s');
    $sql = "UPDATE categories SET name=?,create_at=? WHERE id=?";
    $sql = $conn->prepare($sql);
    try{
        if ($sql->execute(array($name,$create_at,$id))){
            header("Location: ./admin_cate.php");
        }else{
            throw new Exception("update error");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
?>