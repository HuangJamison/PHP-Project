<div class="msg__form-all">
    <input class="msg__btn" type="button" value="我要留言"/>
    <form class="msg__form hidden" method="POST" action="handle_add_msg.php">
        <input type="hidden" name="parent_id" value=<?php echo $row->id;?> >
        <div class="msg__form-info">
            <div class="msg__form-author">
                <?php
                    if($is_login && $username!==''){
                        echo "<input type='hidden' name='username' value='$username'>";
                        echo $username;
                    }else{
                        echo "<input type='hidden' name='username' value='訪客'>";
                        echo "訪客";
                    }
                ?>
            </div>
            <div class="msg__form-time">
                <?php  date_default_timezone_set("Asia/Taipei"); echo date('Y-m-d H:i'); ?>
            </div>
        </div>
        <div class="msg__form-content">
            <textarea rows="5" cols="40" name="content" placeholder="想說什麼呢..."></textarea>
        </div>
        <div class="msg__form-submit">
            <input type="submit" value="送出"/>
        </div>
    </form>
</div>