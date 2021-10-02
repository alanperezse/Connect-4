<?php
require_once 'MoveStrategy.php';
    
class RandomStrategy extends MoveStrategy {
    function pickSlot(Board $board, $player) {
        // Select a random number
        $slot = rand(0, 6);
        
        // Make move and return chosen slot
        while(!$board->makeMove($slot, $player)) {
            $slot = ($slot + 1) % 7;
        }
        
        return $slot;
    }
}
/*
$board = new Board();
$board->places[0] = [1, 1, 1, 1, 1 ,1];
$board->places[1] = [1, 1, 1, 1, 1 ,1];
$board->places[2] = [1, 1, 1, 1, 1 ,0];
$board->places[3] = [1, 1, 1, 1, 1 ,1];
$board->places[4] = [1, 1, 1, 1, 1 ,1];
$board->places[5] = [1, 1, 1, 1, 1 ,0];
$board->places[6] = [1, 1, 1, 1, 1 ,0];

$strat = new RandomStrategy();
echo $strat->pickSlot($board) . '</br>';
$board->print_contents();
*/
?>