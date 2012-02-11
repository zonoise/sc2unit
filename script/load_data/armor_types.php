<?php
require_once(__DIR__ .'/../../lib/db.php');
$db=Db::pdo();

$attr= array( 'Light','Armored','Biological','Mechanical',
       'Psionic','Massive','Structure');

$stmt = $db->prepare('insert into armor_types (id,name) values (?,?)');
foreach($attr as $k => $v){
  $stmt->execute(array($k,$v));
}
?>
