<?php
class ArmorTypeUnit extends ActiveRecord\Model{
  static $table_name = 'armor_type_unit';
  static $belongs_to = array(
    array('unit'),
    array('armor_type','class_name'=>'ArmorType')
  );
  
}
?>
