<?php
require_once(__DIR__ . '/../lib/lessc.inc.php');

$input = 'style.less';

$lc = new lessc($input);

try {
    file_put_contents('style.css', $lc->parse());
} catch (exception $ex) {
    exit($ex->getMessage());
}

?>
