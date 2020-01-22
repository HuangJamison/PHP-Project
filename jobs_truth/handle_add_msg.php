<?php
    date_default_timezone_set("Asia/Taipei");
    require_once('conn_pgdb.php');
    $parent_id = $_POST['parent_id'];
    $content = $_POST['content'];
    $username = $_POST['username'];
    $create_at = date('Y-m-d H:i');
    if (empty($content)){
        echo "<a href='index.php' ><input type='button' value='回上一頁'/></a>";
        die("你的留言是空值哦!!");
    }
    $sql = "INSERT INTO comments (username,parent_id,content,create_at) VALUES (?,?,?,?)";
    $result = $conn->prepare($sql);
    try{
        $result->execute(array($username,$parent_id,$content,$create_at));
        header("Location: ./index.php");
    }catch(PDOException $e){
        die("Error:" . $e->getMessage());
    }
?>