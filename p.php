<?php
require_once ("connection.php");

if (){
    print_r($_FILES);
    echo "YESssss";
} else {
    echo "NO";
    $stmt = $pdo->prepare("SELECT `img` FROM `bike` WHERE `id` = 2");
    while ($row = $stmt->fetch())
    {
        $img_name = $row['img'];
        echo $img_name;
    echo "fe";
    }
    
}
?>