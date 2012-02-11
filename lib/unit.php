<?php
require_once('db.php');

class Unit {
  private $pdo ;
  public $values ;
  public function __cunstruct($f){
    $this->fields = $f;
  }

  static public function find($id){
    $db=Db::pdo();

    $stmt = $db->prepare('select * from units where id = ?');
    //echo($stmt->errorInfo());
    $result = $stmt->execute(array($id));
    $f = $stmt->fetch(PDO::FETCH_ASSOC);
    $unit = new Unit();
    $unit->set_values($f);
    return $unit;
  }

  static public function find_by_name($name){
    $db=Db::pdo();
    $stmt = $db->prepare('select * from units where name = ?');
    $result = $stmt->execute(array($name));
    $f = $stmt->fetch(PDO::FETCH_ASSOC);
    return $f;
    #$unit = new Unit();
    #$unit->set_values($f);
    #return $unit;
  }

  static public function find_by_race($race){
    $db=Db::pdo();
    $stmt = $db->prepare('select * from units where race = ?');
    $result = $stmt->execute(array($race));
    $rows = $stmt->fetchAll();
    return $rows;
  }

  static public function find_by_armor_type($attr){
    $db=Db::pdo();
    $stmt = $db->prepare('
    SELECT units.* 
    FROM  (units 
    LEFT JOIN  armor_type_unit ON units.id = armor_type_unit.unit_id )  
    LEFT JOIN armor_types ON  armor_type_unit.armor_type_id = armor_types.id 
    WHERE  armor_types.name=?');
    $result = $stmt->execute(array($attr));
    $rows = $stmt->fetchAll();
    return $rows;
  }

  static public function find_armor_type($id){
    $db=Db::pdo();
    $stmt = $db->prepare('
    SELECT armor_types.name as armor_types
    FROM  units 
    LEFT JOIN armor_type_unit ON units.id = armor_type_unit.unit_id 
    LEFT JOIN armor_types     ON armor_type_unit.armor_type_id = armor_types.id
    WHERE units.id=?;    ');
    $result = $stmt->execute(array($id));
    $rows = $stmt->fetchAll();
    return $rows;
  }

  function set_values($values){
    $this->values=$values;
  }

  public function values(){
    return $this->values;
  }

  function save(){
    $db=Db::pdo();
    $result = $db->query('insert into units set '
     .$this->implodeAssoc($this->values));
    return $result;
  }

  function update(){
    $db=Db::pdo();
    $result = $db->query('update units set '
     .$this->implodeAssoc($this->values).'where id='.$this->values['id']);
    return $result;
  }

  //Create Text for SQL's SET statment from  Associative array
  private function implodeAssoc($array,$glue1=',',$glue2='='){
    $tmp_ary=array();
    foreach($array as $k => $v){
      if(0 < strlen((String)$v)){
        array_push($tmp_ary,(String)$k.$glue2."\"".(String)$v."\""); 
      }
    }
    return implode($glue1,$tmp_ary);
  }
}

function create_unit($values){
  $u = new Unit();
  $u->set_values($values);
  $u->save();
}


?>
