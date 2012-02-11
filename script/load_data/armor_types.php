<?php
require_once(__DIR__ .'/../../lib/db.php');
try{

$db=Db::pdo();

$attr= array('Light','Armored','Biological','Mechanical',
       'Psionic','Massive','Structure');

$stmt = $db->prepare('insert into armor_types (id,name) values (?,?)');
foreach($attr as $k => $v){
  print($v);
  $stmt->execute(array($k,$v));
  print_r($stmt->errorInfo());
}

}catch(PDOException $e){
  print_r($pdo->errorInfo());
  echo 'Connection failed: ' . $e->getMessage();
}
?>
