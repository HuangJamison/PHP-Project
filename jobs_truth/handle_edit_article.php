<?php
    date_default_timezone_set("Asia/Taipei");
    require_once('conn_pgdb.php');
    $id = $_POST['id'];
    $company = $_POST['company'];
    $good = $_POST['good'];
    $bad = $_POST['bad'];
    $create_at = date('Y-m-d H:i');
    if (empty($company)||empty($good)||empty($bad)){
        echo "<a href='index.php' ><input type='button' value='回上一頁'/></a>";
        die("輸入的內容有空值哦! 請多充實內容"); 
    }
    $sql = "UPDATE articles SET company=?,good=?,bad=?,create_at=? WHERE id=?";
    $result = $conn->prepare($sql);
    try{
        $result->execute(array($company,$good,$bad,$create_at,$id));
        header("Location: ./index.php");
    }catch(PDOException $e){
        die("Error:" . $e->getMessage());
    }
?>