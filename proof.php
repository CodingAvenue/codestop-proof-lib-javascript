<?php

require_once('vendor/autoload.php');

use CodeStop\Proof\JS;

$js = new JS('./code');

$console = $js->find('call-expression[name="console", property="log"]');
$args = $console->getSubNode('arguments');
$exp = $args->find('binary-expression[name="+"]');
$left = $exp->getSubNode('left');
print_r($left);
