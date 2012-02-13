<?php
require_once __DIR__.'/silex.phar'; 
#require_once __DIR__.'../config/database.php' ;#Database setting info $db_config
#require_once __DIR__.'/../config/database.php' ;
require_once __DIR__.'/../lib/unit.php';
$app = new Silex\Application(); 
$app['debug'] = true;

//Register Twig Extension
$app->register(new Silex\Provider\TwigServiceProvider(),array(
  'twig.path'           => __DIR__.'/../views' ,
  'twig.class_path' => __DIR__.'/../vender/Twig/lib'
));

//Redgister Doctorine 
/*$app->register(
  new Silex\Provider\DoctrineServiceProvider(), 
    array(
      'db.options'            => 
        array(
          'driver'    => 'pdo_mysql',
          'host'      =>  $db_config['host_name'],
          'port'      =>  $db_config['port'],
          'dbname'    =>  $db_config['db_name'],
          'user'      =>  $db_config['uname'],
          'password'  =>  $db_config['password'],
        ),
    'db.dbal.class_path'    => __DIR__.'/../vender/doctrine-dbal/lib',
    'db.common.class_path'  => __DIR__.'/../vender/doctrine2-common/lib'
    )
);
*/
$app->get('/', function() use($app) { 
  return  $app['twig']->render('top.twig');
}); 

#about page (static html )
$app->get('/about', function() use($app) { 
  $name = 'hage';
  return  $app['twig']->render('about.twig',array('name' => $name)); 
}); 

$app->get('/race/{race}', function($race) use($app) { 
  $units = Unit::find_by_race($race);
  return  $app['twig']->render('units.twig',array('units' => $units));
}); 

$app->get('/unit/{id}', function ($id) use ($app) {
  $unit = Unit::find($id);
  $armor_types =Unit::armor_types($id);
  
  return  $app['twig']->render('unit.twig',
          array(
            'unit' => $unit,
            'armor_types'=>$armor_types ,
          ));
});

$app->get('/armor/{armor_type}', function ($armor_type) use ($app) {
  $units = Unit::find_by_armor_type($armor_type);
  return  $app['twig']->render('units.twig',array('units' => $units)); 
});

$app->error(function (\Exception $e, $code) use ($app) {
  return 'We are sorry, but something went terribly wrong.'
  . $code .'<pre>'.$e . '</pre>';
});

$app->run(); 
?>
