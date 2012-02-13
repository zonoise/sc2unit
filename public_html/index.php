<?php
require_once __DIR__.'/silex.phar'; 

require_once __DIR__.'/../lib/setup-activerecord.php';
$app = new Silex\Application(); 
$app['debug'] = true;
$app['root']=dirname($_SERVER['PHP_SELF']);
//Register Twig Extension
$app->register(new Silex\Provider\TwigServiceProvider(),array(
  'twig.path'           => __DIR__.'/../views' ,
  'twig.class_path' => __DIR__.'/../vender/Twig/lib'
));

$app->get('/', function() use($app) { 
  return  $app['twig']->render('top.twig');
  #return $app['doc_root'];
}); 

#about page (static html )
$app->get('/about', function() use($app) { 
  $name = 'hage';
  return  $app['twig']->render('about.twig',array('name' => $name)); 
}); 

$app->get('/race/{race}', function($race) use($app) { 
  $units = Unit::find_all_by_race($race);
  return  $app['twig']->render('units.twig',array('units' => $units));
}); 

$app->get('/unit/{id}', function ($id) use ($app) {
  $unit = Unit::find($id);
  $armor_types =$unit->armor_types;
  
  return  $app['twig']->render('unit.twig',
          array(
            'unit' => $unit,
            'armor_types' => $armor_types
          ));
});

$app->get('/armor/{armor_type}', function ($armor_type) use ($app) {
  $armor_type = ArmorType::find_by_name($armor_type);
  return  $app['twig']->render('units.twig',array('units' => $armor_type->units)); 
});

$app->error(function (\Exception $e, $code) use ($app) {
  return 'We are sorry, but something went terribly wrong.'
  . $code .'<pre>'.$e . '</pre>';
});

$app->run(); 
?>
