<?php
require_once(__DIR__ .'/../../lib/db.php');
try{

$db=Db::pdo();

$attr= array('Light','Armored','Biological','Mechanical',
       'Psionic','Massive','Structure');

$stmt = $db->prepare('insert into armor_types (id,name) values (?,?)');
foreach($attr as $k => $v){
  
  print($k);
  print($v);
  $stmt->execute(array($k,$v));
  $errorInfo = $stmt->errorInfo();
  if($errorInfo[1]){
    print_r($errorInfo);
  }
}

}catch(PDOException $e){
  print_r($pdo->errorInfo());
  echo 'Connection failed: ' . $e->getMessage();
}
?>
