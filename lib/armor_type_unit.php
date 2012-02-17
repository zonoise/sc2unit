<?php
require_once('db.php');

class ArmorTypeUnit {

  function save($values){
    $db=Db::pdo();
    $result = $db->query('insert into armor_type_unit set '
     .$this->implodeAssoc($values));
    return $result;
  }
  public static function insert($values){
    $db=Db::pdo();
    
    $result = $db->query('insert into armor_type_unit set '
     . ArmorTypeUnit::implodeAssoc($values));
    print_r( $db->errorCode());
    print_r( $db->errorInfo());
    return $result;
  }
  //Create Text for SQL's SET statment from  Associative array
  public static function implodeAssoc($array,$glue1=',',$glue2='='){
    $tmp_ary=array();
    foreach($array as $k => $v){
      if(0 < strlen((String)$v)){
        array_push($tmp_ary,(String)$k.$glue2."\"".(String)$v."\""); 
      }
    }
    return implode($glue1,$tmp_ary);
  }
}

function create_armor_type_unit($values){
  $result = ArmorTypeUnit::insert($values);
  print_r($result);
}


?>
