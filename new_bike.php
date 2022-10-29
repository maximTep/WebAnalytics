<?php
require_once ("connection.php");

$name = $_POST['name'];
$MAX_FILE_SIZE = $_POST['MAX_FILE_SIZE'];
$type = $_POST['type'];
$brand = $_POST['brand'];
$frameset = $_POST['frameset'];
$wheelset = $_POST['wheelset'];
$transmission = $_POST['transmission'];
$parent = $_POST['parent'];

//загрузка картинки
$target_dir = "img/";
$img_name = time() . "_" . $name . "_" . basename($_FILES["file_upload"]["name"]);
$target_file = $target_dir . $img_name;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file);

// записть в таблицу
$stm = $pdo->prepare("INSERT INTO `bike`
                        (`id`, `type`, `brand`, `name`, `frameset`, `wheelset`, `transmission`, `img`)
                    VALUES
                        (:id, :type, :brand, :name, :frameset, :wheelset, :transmission, :img)");

$stm->execute(array ('id' => null,
                     'type' => $type,
                     'brand' => $brand,
                     'name' => $name,
                     'frameset' => $frameset,
                     'wheelset' => $wheelset,
                     'transmission' => $transmission,
                     'img' => $img_name
                    ));
?>
<script>document.location.replace("<?php echo $parent; ?>");</script>
