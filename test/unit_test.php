<?php
require_once(__DIR__ . '/../lib/unit.php');

/* Unit create */
echo "--Create Test--\n";
$u = new Unit();

$values=array(
'id'=>2,
'name'=>'Probe',
'mineral'=>150
);
$u->set_values($values);
$u->save();

/* Unit find */
echo "--Find Test--\n";
$u2 = Unit::find(2);
print_r($u2);
echo "---\n";

$values = $u2->values();
print($values['id'] . "\n");
print($values['name']. "\n");

/* Unit Update */
echo "--Update Test--\n";
$u2 = Unit::find(2);
$values = $u2->values();
if($values['name']=='Probe'){
  $values['name']='Infester';
}else{
  $values['name']='Probe';
}
$u2->set_values($values);
$u2->update();

/* find by name */
$u3 = Unit::find_by_name('Probe');
print_r($u3);
?>
