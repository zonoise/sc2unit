<?php
require_once(__DIR__ . '/../config/database.php');

class Db {
  public $pdo =null;
  
  public function __construct(){

  }

  static public function pdo(){
    try{
      global $db_config;
      $pdo = new PDO("mysql:host=".$db_config['host_name'].';port='.$db_config['port'] . "; dbname=".$db_config['db_name'],
                   $db_config['uname'],
                   $db_config['password']);
      print_r("mysql:host=".$db_config['host_name'].';port='.$db_config['port'] . "; dbname=".$db_config['db_name']
                   . $db_config['uname'].
                   $db_config['password']);
      //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->query("use ".$db_config['db_name']);
      return $pdo;
    }catch(PDOException $e){
       echo 'Connection failed: ' . $e->getMessage();
      return null;
    }
  }
}
?>
