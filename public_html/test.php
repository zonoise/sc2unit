<?php

$file_name='silex.phar';
$p = new Phar($file_name, 0);


echo  __DIR__.'/../vendor/doctrine-dbal/lib' ;
echo '<pre>';
foreach (new RecursiveIteratorIterator($p) as $file) {

        echo  preg_replace("/^.+$file_name/",$file_name,$file->getPathname());
        echo '  getFileName  ';   echo $file->getFileName() . "\n";
        if ($file->getFileName()=='DoctrineServiceProvider.php'){
            echo file_get_contents($file->getPathName()) ;
        }
}



echo '<pre>';

?>
