<?php
require_once 'MoveStrategy.php';

class SmartStrategy extends MoveStrategy {
    function pickSlot(Board $board, $player) {   
        // Attempt to win if possible
        for($i = 0; $i < 7; $i++) {
            // If placing a slot makes it win
            $temp = clone $board; // Interact with clone array as opposed to real one
            if($temp->makeMove($i, $player) && $temp->checkWin($i)) {
                $board->makeMove($i, $player);
                return $i;
            }
        }
        
        // Attempt to do every move as the player
        for($i = 0; $i < 7; $i++) {
            // If player wins any, block it
            $temp = clone $board; // Interact with clone array as opposed to real one
            if($temp->makeMove($i, 1) && $temp->checkWin($i)) {
                $board->makeMove($i, $player);
                return $i;
            }
        }
        
        // Else return some valid random number
        $slot = rand(0, 6);
        
        // Make move and return chosen slot
        while(!$board->makeMove($slot, $player)) {
            $slot = ($slot + 1) % 7;
        }
        
        return $slot;
    }
}
?>