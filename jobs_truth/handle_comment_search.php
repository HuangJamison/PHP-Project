<?php
    // 1. 定義傳輸格式
    header('Content_Type: application/json; charset=utf-8');
    $comm_id = $_GET['comm_id'];
    require_once('conn_pgdb.php');
    $sql = "SELECT * FROM comments WHERE id = ?";
    $result = $conn->prepare($sql);
    try{
        $result->execute(array($comm_id));
        while($row = $result->fetchObject()){
            $res_data = array('status'=>'success',
                              'data'=>array(),
                              'message'=>'拿取資料成功');
             array_push($res_data['data'],array(
                                          'comment_id'=> $row->id,
                                          'comment_content'=> $row->content,
                                          'comment_username'=>$row->username
             ));
        }
        echo json_encode($res_data);
    }catch(PDOException $e){
        die ("Error:" . $e->getMessage());
    }

?>