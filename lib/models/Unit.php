<?php
class Unit extends ActiveRecord\Model{
  static $table_name = 'units';
  static $has_many = array(
    array('armor_type_unit','class_name'=>'ArmorTypeUnit')
   ,array('armor_types','through'=>'armor_type_unit','class_name'=>'ArmorType')
  );
}
?>
