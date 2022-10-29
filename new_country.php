<?php
require_once ("connection.php");

$country = $_POST['country'];
$parent = $_POST['parent'];

$stm = $pdo->prepare("INSERT INTO `coutres` SET `id` = :id, `country` = :country");

$stm->execute(array ('id' => null, 'country' => $country));
?>
<script>document.location.replace("<?php echo $parent ?>");</script>