<?php
    require_once("test_pgdb.php");
    $cate = $_POST['cate'];
    $create_at = date("Y-m-d H:i:s");
    if (empty($cate)){
?>
        <a href="cate_add.php"><input type="button" value="回上一頁"></a>
<?php    
            die("請重新確認分類名字是否為不為空!!");
    }
    $sql = "INSERT INTO categories (name,create_at) VALUES (?,?)";
    // if($sql->execute(array($cate,$create_at))){
    //     echo "成功";
    // }else{
    //     echo "新增失敗" . "原因為:" . $conn->error;
    // }
    try{
        $sql = $conn->prepare($sql);
        if ($sql->execute(array($cate,$create_at))){
            header("Location: ./admin_cate.php");
            // echo "執行成功";
        }else{
            throw new Exception("新增分類失敗");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
?>