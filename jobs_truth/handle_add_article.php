<?php
    date_default_timezone_set("Asia/Taipei");
    require_once('conn_pgdb.php');
    $company = $_POST['company'];
    $good = $_POST['good'];
    $bad = $_POST['bad'];
    $create_at = date('Y-m-d H:i');
    $username = $_POST['username'];
    if (empty($company)||empty($good)||empty($bad)||empty($create_at)){
        echo "<a href='index.php' ><input type='button' value='回上一頁'/></a>";
        die("輸入的內容有空值哦! 請多充實內容"); 
    }
    $sql = "INSERT INTO articles (username,company,good,bad,create_at) VALUES (?,?,?,?,?)";
    $result = $conn->prepare($sql);
    try{
        $result->execute(array($username,$company,$good,$bad,$create_at));
        header("Location: ./index.php");
    }catch(PDOException $e){
        die("Error:" . $e->getMessage());
    }
?>