<?php
require_once(__DIR__ . '/../lib/lessc.inc.php');

$input = __DIR__ .'/../public_html/css/style.less';
$output = __DIR__ .'/../public_html/css/style.css';

$lc = new lessc($input);

try {
    file_put_contents($output, $lc->parse());
} catch (exception $ex) {
    exit($ex->getMessage());
}

?>
