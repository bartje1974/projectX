<?php
ini_set('error_reporting', E_ALL);
ini_set("display_errors", 1);
$begin_tijd =  microtime();
$begin_mem = memory_get_usage();

require_once 'projectx/core/autoload.php';

use projectx\core\app;
$app = new app;

$eind_tijd = microtime() - $begin_tijd;
$eind_mem = memory_get_usage() - $begin_mem;
echo '<br />';
echo "Tijd: <strong>", round($eind_tijd, 6), "</strong> seconde<br />";
echo "Geheugen: <strong>", round((($eind_mem / 1024) / 1024), 6), "</strong> MB <br />"; 
//echo '<pre>';
//print_r(get_declared_classes());
//echo '</pre>';