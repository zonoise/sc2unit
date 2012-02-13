<?php

require_once(__DIR__ . '/../../lib/armor_type_unit.php');
try {
$unit_csv = fopen( __DIR__ .'/../../fixture/armor_type_unit.csv','r' ) or die(" ");
$lines = fgetcsv($unit_csv ); //first line is Label
$id=0;
while( ( $lines = fgetcsv($unit_csv ) ) !== FALSE ){
  $unit_id = array_shift($lines);
  array_shift($lines); //race
  array_shift($lines); //unitname
  print_r($lines);
  foreach($lines as $k => $v){
   
    if($v=='1'){
      create_armor_type_unit(array(
                'id'=>$id ,
                'unit_id' => $unit_id,
                'armortype_id' =>$k 
      ));
      $id++;
    }
  }
}

}catch(PDOException $e){
  echo 'Connection failed: ' . $e->getMessage();
}

?>
