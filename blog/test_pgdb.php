<?php
    $host = "ec2-174-129-33-30.compute-1.amazonaws.com";
    $user = "zexfhxmdyaamyo";
    $password = "03395c93073284532bfe76d854be7d95e70dd811ec69fa5eb6656702fa6ba707";
    $db_name = "d4s4tj29ke48u0";
    $port = "5432";
    try{
        $dsn = "pgsql:host=" . $host . ";port=" . $port . ";dbname=" . $db_name
        . ";user=" . $user . ";password=" . $password . ";";
        // create PDO instance
        $conn = new PDO($dsn,$user,$password);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);//Set default fetch mode. Description of modes is available
        //false只能在服務端執行(禁止預處理SQL語句，能確保語句和參數傳給Server前，未被php處理及操作) true在prepare階段不發送至SQL Server(本地) execute才發送至服務端
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);  
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // 錯誤回報
    }catch(PDOException $e){
        echo 'connection fail:' .$e->getMessage();
    }
?>