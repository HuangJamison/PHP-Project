<?php
    $arr=[];
    for($i=0;$i<10;$i++){
        array_push($arr,$i);
    }
    // foreach ($arr as $value) {
    //     echo "Value:" . $value . "<br>";
    // }
    // foreach ($arr as $key => $value) {
    //     echo "key:" . $key . "val:" . $value . "<br>";
    // }
    $arr2 = array_map(function($val){
        return $val*2;
    },$arr);
    var_dump($arr2);
?>