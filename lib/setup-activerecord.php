
<?php
require_once(__DIR__ . '/../config/database.php');
require_once dirname(__FILE__).'/php-activerecord/ActiveRecord.php';
try{
 
 ActiveRecord\Config::initialize(function($cfg)
 {
   global $db_config;
   $cfg->set_model_directory(dirname(__FILE__) . '/models');
   $cfg->set_connections(array('development' =>
    "mysql://".$db_config['uname'].':'.$db_config['password'].'@'.$db_config['host_name']."/".$db_config['db_name']));
 });

                   
}catch (Exception $e) {
    echo  $e->getMessage();
}

?>
