<?php // index.php
require_once 'GameInfo.php';

define('WIDTH', 7);
define('HEIGHT', 6);

$strategies = array("Smart" => "SmartStrategy", "Random" => "RandomStrategy");
// create a structure: a class or an array (of key-value pairs)
$info = new GameInfo(WIDTH, HEIGHT, array_keys($strategies));
echo json_encode($info);
?>