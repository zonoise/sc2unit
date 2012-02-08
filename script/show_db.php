<?php
require_once(__DIR__ . '/../config/database.php');

#databases
#$pdo = new PDO("mysql:host=localhost; dbname=sc2unit","root", null);
$pdo = new PDO("mysql:host=".$db_config['host_name']."; dbname=".$db_config['db_name'],
                 $db_config['uname'],
                 $db_config['password']);
$sth = $pdo->prepare("show databases");
$sth->execute();
while($result = $sth->fetchColumn()){
  var_dump( $result);
  echo('<br>');
}

$result = $pdo->query("use ".$db_config['db_name']);

#tables
$sth = $pdo->prepare("show tables");
$sth->execute();
$tables = $sth->fetchAll();
function select_0($table){return $table[0]; }
$table_names = array_map("select_0",$tables);
foreach($table_names as $table_name){
  echo $table_name.'<br>';
}

#columns
function show_columns($table_name,$pdo){
  echo('----'.$table_name.'----<br>');
  $sth_col = $pdo->query("show columns from ". $table_name);
  $fields = $sth_col->fetchAll();
  foreach($fields as $f){
    echo($f['Field'] .'/'. $f['Type'].'/'.$f['Extra']  .' <br>');
  }
}

foreach($table_names as $table_name){
  show_columns($table_name,$pdo);
}

?>
