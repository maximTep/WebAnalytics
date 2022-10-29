<?php
require_once ("connection.php");

$country = $_POST['country'];
$parent = $_POST['parent'];
$brand = $_POST['brand'];
$id = $_POST['id'];

$stm = $pdo->prepare("UPDATE `brands` SET `name` = :name, `country` = :country WHERE `id` = :id");
$stm->execute(array ('id' => $id, 'name' => $brand, 'country' => $country));
?>
<script>document.location.replace("<?php echo $parent ?>");</script>