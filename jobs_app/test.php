<?php
    $arr = array('hi'=>5,'hello'=>10,'user'=>array('name'=>'jj'));
    echo $arr['user']['name'];
    class Car{
        var $greet='Hi!!', $price=550;
        function cc($art){
            return $art;
        }
        function greeting($name){
            return "<br>" . $this->greet . $name . ",price:" . $this->price;
        }
    }
    $new_item = new Car();
    echo $new_item->cc('times');
    echo $new_item->greeting('Jamie');
?>