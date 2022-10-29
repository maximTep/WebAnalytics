<?php
require_once ("connection.php");

$country = $_POST['country'];
$parent = $_POST['parent'];
$brand = $_POST['brand'];

$stm = $pdo->prepare("INSERT INTO `brands` SET `id` = :id, `name` = :name, `country` = :country");
$stm->execute(array ('id' => null, 'name' => $brand, 'country' => $country));
?>
<script>document.location.replace("<?php echo $parent ?>");</script>