<?php
require_once(__DIR__ . '/../config/database.php');
require_once(__DIR__ . '/../lib/db.php');
try {
  $pdo=Db::pdo();
  
  $tables= array("abilities", "armor_types" ,"armor_type_unit","atacks","units");
  foreach($tables as $table_name){
    $result = $pdo->query("drop table if exists ".$table_name);
  }
  
  //[0]sqlstate error code [1] [2] 
  $errorInfo = $pdo->errorInfo();
  if($errorInfo[1]){
    print_r($errorInfo);
  }

}catch(PDOException $e){
  echo 'Connection failed: ' . $e->getMessage();
}?>
