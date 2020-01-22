<?php
    // POST id... SQL
    if (!empty($_POST['username']) && (!empty($_POST['password']))){
        require_once('conn_pgdb.php');
        $username = $_POST['username'];
        $password = $_POST['password'];
        $create_at = date('Y-m-d H:i');
        $sql = "INSERT INTO users (username,password,create_at) VALUES (?,?,?)";
        $result = $conn->prepare($sql);
        try{
            $result->execute(array($username,$password,$create_at));
            $last_id = $conn->lastInsertId();
            setcookie("username",$username,time()+3600*24); // 名字, 設定 username, expire time
            header("Location: ./index.php");
        }catch(PDOException $e){
            die("Error:" . $e->getMessage());
        }
    }
?>
<h2 class="reg__title">註冊頁面</h2>
<form method="POST" action="register.php">
    <div class="reg__username">
        Set Username: <input type="text" name="username">
    </div><br>
    <div class="reg__password">
        Set Password: <input type="password" name="password">
    </div><br>
    <input type="submit" value="Submit">
</form>