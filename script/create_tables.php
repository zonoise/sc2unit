<?php
require_once(__DIR__ . '/../config/database.php');
//
// UNIT
//
$create_table1 = "
create table if not exists 
units
(
  id          int not null auto_increment,
  name        text not null,
  mineral     int,
  gas         int,
  supply      int,
  buildtime   int,
  life        int,
  sields      int, 
  energy      int,
  armor       int,
  movement_speed    float,
  sight_range int,
  race text,
  image_url   text,
  PRIMARY KEY (id)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;";

//
//ARMOR TYPE
//
$create_table2 = "
create table if not exists 
armor_types
(
  id            int not null auto_increment,
  name          text not null,
  PRIMARY KEY (id)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;";

//
//AROMOR TYPE UNIT
//
$create_table3 = "
create table if not exists 
armor_type_unit
(
  id            int not null,
  unit_id       int not null,
  armor_type_id  int not null,
  PRIMARY KEY (id)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;";

//
//Atacks
//
$create_table4 = "
create table if not exists 
atacks
(
  id            int not null ,
  unit_id       int not null,
  discription   text,
  
  speed         float ,
  sprash        float ,
  base_damage   float ,
  dps           float ,
  ground        float ,
  air           float ,
  attack_range         float ,
  growth_per_upgrade   int not null,
  bonus_armor_type_id  int not null,
  bonus_point   int not null,
  image_url     text,
  PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;";

//
//Abilities
//
$create_table5 = "
create table if not exists 
abilities
(
  id          int not null,
  name        text not null,
  discription text,
  image_url   text
)ENGINE=InnoDB  DEFAULT CHARSET=utf8";

try {
  $pdo = new PDO("mysql:host=".$db_config['host_name']."; dbname=".$db_config['db_name'],
                 $db_config['uname'],
                 $db_config['password']);

  $result = $pdo->query("create schema if not exists ". $db_config['db_name']);
  $result = $pdo->query("use ".$db_config['db_name']);

  $result = $pdo->query($create_table1);
  $result = $pdo->query($create_table2);
  $result = $pdo->query($create_table3);
  $result = $pdo->query($create_table4);
  $result = $pdo->query($create_table5);
  print_r($pdo->errorInfo());
}catch(PDOException $e){
  print_r($pdo->errorInfo());
  echo 'Connection failed: ' . $e->getMessage();
}?>

