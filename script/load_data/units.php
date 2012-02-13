<?php

require_once(__DIR__ . '/../../lib/unit.php');
try {
$unit_csv = fopen( __DIR__ .'/../../fixture/unit.csv','r' ) or die(" ");
$lines = fgetcsv($unit_csv ); //first line is Label
while( ( $lines = fgetcsv($unit_csv ) ) !== FALSE ){

  //setting between csv and db
  create_unit(array(
    'id'          =>$lines[0],
    'race'        =>$lines[1],
    'name'        =>$lines[2],
    'mineral'     =>$lines[3],
    'gas'         =>$lines[4],
    'supply'      =>$lines[5],
    'buildtime'   =>$lines[6],
    'life'        =>$lines[7],
    'sields'      =>$lines[8], 
    'energy'      =>$lines[9],
    'armor'       =>$lines[10],
    'movement_speed' => '',
    'sight_range' => '',
    'image_url'   => '',
  ));
}

}catch(PDOException $e){
  echo 'Connection failed: ' . $e->getMessage();
}

?>
