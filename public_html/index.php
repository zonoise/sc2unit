<?php
require_once __DIR__.'/silex.phar'; 
require_once __DIR__.'../config/database.php' #Database setting info $db_config
$app = new Silex\Application(); 
$app['debug'] = true;

//Register Twig Extension
$app->register(new Silex\Provider\TwigServiceProvider(),array(
  'twig.path'           => __DIR__.'/../views' ,
  'twig.class_path' => __DIR__.'/../vender/Twig/lib'
));

//Redgister Doctorine 
$app->register(
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
    'db.common.class_path'  => __DIR__.'/../vender/doctrine-dbal/lib/vendor/doctrine-common/lib'
    )
);


$app->get('/', function() use($app) { 
  return 'top'; 
}); 

#about page (static html )
$app->get('/about', function() use($app) { 
  $name = 'hage';
  return  $app['twig']->render('about.twig',array('name' => $name)); 
}); 

$app->get('/units/{id}', function ($id) use ($app) {
    $sql = "SELECT * FROM units WHERE id = ?";
    $unit = $app['db']->fetchAssoc($sql, array((int) $id));

    return var_dump($unit);
});

$app->error(function (\Exception $e, $code) use ($app) {
  return 'We are sorry, but something went terribly wrong.'
  . $code .'<pre>'.$e . '</pre>';
});

$app->run(); 
?>
