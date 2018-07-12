<?php

require_once('vendor/autoload.php');

use CodeStop\Proof\JS;
use CodeStop\Proof\JS\Nodes;

$js = new JS('./code');

print_r($js);