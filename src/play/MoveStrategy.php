<?php
require_once 'Board.php';

abstract class MoveStrategy {   
    abstract function pickSlot(Board $board, $player);
    
    function toJson() {
        return array(‘name’ => get_class($this));
    }
    
    static function fromJson() {
        $strategy = new static();
        return $strategy;
    }
}
?>