<?php
require_once(__DIR__ . '/../config/database.php');
try {
  $pdo = new PDO("mysql:host=".$db_config['host_name']."; dbname=".$db_config['db_name'],
                 $db_config['uname'],
                 $db_config['password']);

  $result = $pdo->query("use ".$db_config['db_name']);


  $tables= array("abilities", "armor_types" ,"armor_type_unit","atacks","units");
  foreach($tables as $table_name){
    $result = $pdo->query("drop table ".$table_name);
  }
  print_r($pdo->errorInfo());
}catch(PDOException $e){
  echo 'Connection failed: ' . $e->getMessage();
}?>
