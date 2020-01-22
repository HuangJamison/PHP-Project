<?php
    require_once('conn_pgdb.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM comments WHERE id=?";
    $result = $conn->prepare($sql);
    try{
        $result->execute(array($id));
        header("Location: ./index.php");
    }catch(PDOException $e){
        die("Error:" . $e->getMessage());
    }
?>