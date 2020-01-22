<?php
    $servername = "localhost";
    $username = "root";
    $password = "123456";
    $dbname = "mentor";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error){
        die("connection fail!" . $conn->connect_error);
    }
    mysqli_set_charset($conn, "utf8"); //設定php連線至資料庫編碼
?>