<?php
require_once 'RandomStrategy.php';
require_once 'SmartStrategy.php';

define('PLAYER', 1);
define('CPU', 2);

class Game {
    public $strategy;
    public $board;
    
    function __construct(MoveStrategy $strategy) {
        $this->strategy = $strategy;
        $this->board = new Board(); // Initialize board
    }
    
    function makePlayerMove($slot) {
        return $this->board->makeMove($slot, PLAYER);
    }
    
    function makeComputerMove() {
        return $this->strategy->pickSlot($this->board, CPU);
    }
    
    function toJson() { // JSON rep. of this game
        return json_encode(array(
            'strategy' => get_class($this->strategy),
            'board' => $this->board
        ));
    } 
  
    static function fromJsonString($json) {
        $obj = json_decode($json); // instance of stdClass
        $strategy = new $obj->strategy; // new RandomStrategy or SmartStrategy
        $board = $obj->board;
        $game = new Game($strategy);
        $game->board = Board::fromJson(json_encode($board));
        return $game;
    }
}

/*
$game = new Game(new RandomStrategy());
echo $game->makePlayerMove(7) === false ? 'False' : 'True';
echo '</br>';
$game->makePlayerMove(5);
$game->makeComputerMove();
$game->makePlayerMove(3);
$game->makeComputerMove();

var_dump($game);
echo '</br></br>';

$json = $game->toJson();
echo $json . '</br></br>';

$obj = Game::fromJsonString($json);
var_dump($obj);

/*
$game = new Game(new RandomStrategy());
$playerMoves = [4, 2, 1 ,5, 0];
foreach($playerMoves as $slot) {    
    $game->makePlayerMove($slot);
    $game->board->print_contents();
    echo '</br></br>';
    $game->makeComputerMove();
    $game->board->print_contents();
    echo '</br></br>';
}

/*

$game = new Game(new RandomStrategy());
var_dump($game);

echo '</br></br>';

$json = $game->toJson();

$json_obj = Game::fromJsonString($json);
var_dump($json_obj);
*/
?>