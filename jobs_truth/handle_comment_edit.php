<?php
    // 更新 content , create_at where id 
    require_once('conn_pgdb.php');
    $id = $_POST['id'];
    $create_at = $_POST['create_at'];
    $content = $_POST['content'];
    $sql = "UPDATE comments SET create_at=?, content=? WHERE id=?";
    $result = $conn->prepare($sql);
    try{
        $result->execute(array($create_at,$content,$id));
        header("Location: ./index.php");
    }catch(PDOException $e){
        die("Error:" . $e->getMessage());
    }
?>