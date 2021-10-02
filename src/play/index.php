<?php
require_once 'Game.php';
require_once 'SmartStrategy.php';
require_once 'RandomStrategy.php';


define('PID', 'pid');
define('MOVE', 'move');


// Assume false at the beginning
$feedback['response'] = false;

// If no pid specified
if(!array_key_exists(PID, $_GET)) {
    $feedback['reason'] = "Pid unspecified";
    echo json_encode($feedback);
    exit;
}

// If no move specified
if(!array_key_exists(MOVE, $_GET)) {
    $feedback['reason'] = 'Move unspecified';
    echo json_encode($feedback);
    exit;
}

// If pid is invalid
$pid_file = '../writable/' . $_GET[PID] . '.txt';


if(!file_exists($pid_file)) {
    $feedback['reason'] = 'Unknown pid';
    echo json_encode($feedback);
    exit;
}

// Open contents from file and create game object
$json = file_get_contents($pid_file);
$game = Game::fromJsonString($json);

$playerSlot = intval($_GET[MOVE]);

// Make player move
if(!$game->makePlayerMove($playerSlot)) {
    $feedback['reason'] = 'Invalid slot';
    echo json_encode($feedback);
    exit;
}

// Response is true. Update $feedback to reflect that
$feedback['response'] = true;
$feedback['ack_move'] = ['slot' => $playerSlot, 'isWin' => false, 'isDraw' => false, 'row' => []];

if($game->board->checkWin($playerSlot)) {
    $feedback['ack_move']['isWin'] = true;
    $feedback['ack_move']['row'] = $game->board->row;     // Update row
    echo json_encode($feedback);
    exit;
}

if($game->board->checkTie()) {
    $feedback['ack_move']['isDraw'] = true;
    echo json_encode($feedback);
    exit;
}

// Computer's turn
$compSlot = $game->makeComputerMove();
$feedback['move'] = ['slot' => $compSlot, 'isWin' => false, 'isDraw' => false, 'row' => []];

if($game->board->checkWin($compSlot)) {
    $feedback['move']['isWin'] = true;
    $feedback['move']['row'] = $game->board->row;    // Update row
    echo json_encode($feedback);
    exit;
}

if($game->board->checkTie()) {
    $feedback['move']['isDraw'] = true;
    echo json_encode($feedback);
    exit;
}

// Save game in file named as the pid
file_put_contents($pid_file, $game->toJson());

echo json_encode($feedback);
// For testing
//echo '</br></br>';
//$game->board->print_contents();
?>