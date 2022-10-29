<?php
require_once ("connection.php");
print_r($_POST);
$id = $_POST['id'];
$name = $_POST['name'];
$MAX_FILE_SIZE = $_POST['MAX_FILE_SIZE'];
$type = $_POST['type'];
$brand = $_POST['brand'];
$frameset = $_POST['frameset'];
$wheelset = $_POST['wheelset'];
$transmission = $_POST['transmission'];

//загрузка картинки
if ($_FILES["file_upload"]['size']){
    $target_dir = "img/";
    $img_name = time() . "_" . $name . "_" . basename($_FILES["file_upload"]["name"]);
    $target_file = $target_dir . $img_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file);
    // записть в таблицу c новой картинкой
    $stm = $pdo->prepare("UPDATE `bike` SET
    `type`=:type, `brand`=:brand, `name`=:name,
    `frameset`=:frameset, `wheelset`=:wheelset,
    `transmission`=:transmission, `img`=:img
    WHERE `id` = ".$id);

    $stm->execute(array ('type' => $type,
    'brand' => $brand,
    'name' => $name,
    'frameset' => $frameset,
    'wheelset' => $wheelset,
    'transmission' => $transmission,
    'img' => $img_name
    ));
} else {
    // записть в таблицу без изменения картинки
    $stm = $pdo->prepare("UPDATE `bike` SET
    `type`=:type, `brand`=:brand, `name`=:name,
    `frameset`=:frameset, `wheelset`=:wheelset,
    `transmission`=:transmission
    WHERE `id` = ".$id);

    $stm->execute(array ('type' => $type,
    'brand' => $brand,
    'name' => $name,
    'frameset' => $frameset,
    'wheelset' => $wheelset,
    'transmission' => $transmission
    ));
}

?>
<script>document.location.replace("<?php echo '/bike.php?id='.$id; ?>");</script>
