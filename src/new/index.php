<?php
require_once '../play/Game.php';
require_once '../play/SmartStrategy.php';
require_once '../play/RandomStrategy.php';


define('STRATEGY', 'strategy'); // constant

// Returns variables according to the status of the game.
function generatefeedback($strategies) {
    $rtn = ['response' => false];
    
    if (!array_key_exists(STRATEGY, $_GET)) {
        $rtn['reason'] = "Strategy unspecified";
    } elseif (!in_array($_GET['strategy'], $strategies, true)) {
        $rtn['reason'] = "Unknown strategy";
    } else {
        $rtn['response'] = true;
        $rtn['pid'] = uniqid();
    }
    return $rtn;
}

$strategies = array("Smart", "Random"); // supported strategies
$feedback = generatefeedback($strategies);

// Dies if invalid
if($feedback['response'] === false) { // write code here
    // Echo the status of the responses
    echo json_encode($feedback);
    exit;
}

// Create new game
$strategy = $_GET['strategy'] === 'Smart' ? new SmartStrategy() : new RandomStrategy();
$game = new Game($strategy);

// Save game in file named as the pid
file_put_contents("../writable/{$feedback['pid']}.txt", $game->toJson());

// Echo the status of the responses
echo json_encode($feedback);
?>