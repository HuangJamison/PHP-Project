<?php
    $error_msg = ''; // 後續判斷是否為空 不為空要顯示錯誤訊息
    // 查詢login 的帳號與密碼是否符合資料庫的
    if (!empty($_POST['username']) && (!empty($_POST['password']))){
        require_once('conn_pgdb.php');
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE username=? AND password=?";
        $result = $conn->prepare($sql);
        try{
            $result->execute(array($username,$password));
            if($result->rowCount()>0){
                setcookie("username",$username,time()+3600*24); // 名字, 設定 username, expire time
                header("Location: ./index.php");
            }else{
                $error_msg = "帳號密碼錯誤";
            }
        }catch(PDOException $e){
            die("Error:" . $e->getMessage());
        }
    }
?>
<h2 class="login__title">登入頁面</h2>
<h2 class="login__err">
    <?php
        if ($error_msg !==''){
            echo $error_msg;
        }
    ?>
</h2>
<form method="POST" action="login.php">
    <div class="reg__username">
        Username: <input type="text" name="username">
    </div><br>
    <div class="reg__password">
        Password: <input type="password" name="password">
    </div><br>
    <input type="submit" value="Submit">
</form>