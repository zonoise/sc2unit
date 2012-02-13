<?php
class ArmorType extends ActiveRecord\Model{
  static $table_name = 'armor_types';
  static $has_many = 
        array(
          array('armor_type_unit','class_name'=>'ArmorTypeUnit'),
          array('units','through'=>'armor_type_unit')
        );
}
?>
