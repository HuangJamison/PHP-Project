<div class="msgs__all">
<?php
    // 留言處
    require_once('conn_pgdb.php');
    $sql = "SELECT * FROM comments WHERE parent_id = ? ORDER BY create_at DESC";
    $comm_result = $conn->prepare($sql);
    try{
        $comm_result->execute(array($row->id));
        if ($comm_result->rowCount()>0){
            while ($comment_row = $comm_result->fetchObject()){
            // comm_row while 未中斷
?>  
    <div class="msg__container">
        <div class="msg__author">
            <?php echo $comment_row->username . "說:"; ?>
        </div>
        <div class="msg__content">
            <?php echo $comment_row->content; ?>
        </div>
<?php
    //判斷該留言是不是自己留的
    // 如果登入 加上 username === $comment_row->username 就顯示 刪與改
    if(($is_login ===true) && ($username === $comment_row->username)){
?>
        <div class="msg__time">
            <?php echo $comment_row->create_at; ?>
            <div class="msg__edit" data-comm_id="<?php echo $comment_row->id; ?>">
                改
            </div>
            <div class="msg__delete" data-comm_id="<?php echo $comment_row->id; ?>">
                <a href="handle_comment_delete.php?id=<?php echo $comment_row->id;?>">刪除</a>
            </div>
        </div>
    </div>
<?php
    }else{
        // 只顯示時間
?>
        <div class="msg__time">
            <?php echo $comment_row->create_at; ?>
            <div class="msg__edit"></div>
            <div class="msg__delete"></div>
        </div>
    </div>  
<?php
    }
?>
<?php
            }
        }
    }catch(PDOException $e){
        die("Error:" . $e->getMessage());
    }
?>
</div>
