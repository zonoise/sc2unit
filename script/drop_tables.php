<?php
require_once(__DIR__ . '/../config/database.php');
require_once(__DIR__ . '/../lib/db.php');
try {
  $pdo=Db::pdo();
  
  $tables= array("abilities", "armor_types" ,"armor_type_unit","atacks","units");
  foreach($tables as $table_name){
    $result = $pdo->query("drop table ".$table_name);
  }
  print_r($pdo->errorInfo());
}catch(PDOException $e){
  echo 'Connection failed: ' . $e->getMessage();
}?>
