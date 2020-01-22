<?php
    require_once('test_pgdb.php');
    require_once('test_config.php');
?>
<?php
    $sql = "SELECT * FROM jobs";
    $result = $conn->prepare($sql);
    $result->execute();
    $rowCount = $result->rowCount();
    while ($row = $result->fetch()){
        echo $row->title;
    }
?>