<?php
/*
 * 1 corresponds to player
 * 2 corresponds to machine
 */
class Board {
    public $width = 7;
    public $height = 6;
    public $places;
    
    function __construct() {
        // Makes places a 2D array with WIDTH rows and HEIGHT columns
        $this->places = array();
        for($i = 0; $i < $this->width; $i++) {
            $this->places[] = array(); // Push new array into places
            for($j = 0; $j < $this->height; $j++) {
                $this->places[$i][$j] = 0;
            }
        }
    }
    
    function makeMove($slot, $player) {
        if(!$this->validMove($slot)) {
            return false;
        }
        
        $j = 0;
        while($this->places[$slot][$j] !== 0) {
            $j++;
        }
        
        $this->places[$slot][$j] = $player;
        return true;
    }
    
    // Tested
    private function validMove($slot) {
        // Invalid slot
        if($slot < 0 || $this->width <= $slot) {
            return false;
        }
        
        // Is the top of that column 0?
        return $this->places[$slot][$this->height - 1] === 0;
    }
    
    function checkWin($slot) {
        // Obtain coordinate of last placed disk
        $j = 0;
        while($j + 1 < $this->height && $this->places[$slot][$j + 1] !== 0) {
            $j++;
        }
        
        // Obtain value of who last placed it
        // 1 for player, 2 for machine
        $player = $this->places[$slot][$j];
        
        // Should never happen
        if($j >= 7) {
            return false;
        }
        
        // Check for horizontal win
        if($this->horizontalWin($slot, $j, $player)) {
            return true;
        }
        
        // Check for vertical win
        if($this->verticalWin($slot, $j, $player)) {
            return true;
        }
        
        // Diagonal win
        if($this->diagonalWin($slot, $j, $player)) {
            return true;
        }
        
        return false;

    }
    
    function checkTie() {
        for($i = 0; $i < $this->width; $i++) {
            // If there is at least one valid move
            if($this->validMove($i)) {
                return false;
            }
        }
        
        return true;
    }
    
    private function horizontalWin($slot, $j, $player) {
        // Calculate x0
        $x0 = $slot;
        while($x0 - 1 >= 0 && $this->places[$x0 - 1][$j] === $player) {
            $x0--;
        }
        
        // Calculate x1
        $x1 = $slot;
        while($x1 + 1 < $this->width && $this->places[$x1 + 1][$j] === $player) {
            $x1++;
        }
        
        //echo "$x0 - $x1 </br>";
        
        // If max difference is 4 or more
        if($x1 - $x0 + 1 >= 4 ) {
            $this->row = [];
            for($i = 0; $i < 4; $i++) {
                $this->row[$i * 2] = $x0 + $i;
                $this->row[($i * 2) + 1] = $j;
            }
            return true;
        }   
        
        return false;
    }
    
    private function verticalWin($slot, $j, $player) {
        // Calculate y0
        $y0 = $j;
        while($y0 - 1 >= 0 && $this->places[$slot][$y0 - 1] === $player) {
            $y0--;
        }
        
        // Calculate y1
        $y1 = $j;
        
        //echo "$y0 - $y1 </br>";
        
        // If max difference is 4 or more
        if($y1 - $y0 + 1 >= 4 ) {
            $this->row = [];
            for($i = 0; $i < 4; $i++) {
                $this->row[$i * 2] = $slot;
                $this->row[($i * 2) + 1] = $y0 + $i;
            }
            return true;
        }
        
        return false;
    }
    
    private function diagonalWin($slot, $j, $player) {        
        // First evaluate top-left to bottom-right
        $x0 = $slot;
        $y0 = $j;
        while($x0 - 1 >= 0 && $y0 + 1 < $this->height && $this->places[$x0 - 1][$y0 + 1] === $player) {
            $x0--;
            $y0++;
        }
        
        $x1 = $slot;
        $y1 = $j;
        while($x1 + 1 < $this->width && $y1 - 1 >= 0 && $this->places[$x1 + 1][$y1 - 1] === $player) {
            $x1++;
            $y1--;
        }
        
        //echo "$x0, $y0 - $x1, $y1 </br>";
        
        // If max difference is 4 or more
        if($x1 - $x0 + 1 >= 4 ) {
            $this->row = [];
            for($i = 0; $i < 4; $i++) {
                $this->row[$i * 2] = $x0 + $i;
                $this->row[($i * 2) + 1] = $y0 - $i;
            }
            return true;
        }
        
        // Now evaluate bottom-left to top-right
        $x0 = $slot;
        $y0 = $j;
        while($x0 - 1 >= 0 && $y0 - 1 >= 0 && $this->places[$x0 - 1][$y0 - 1] === $player) {
            $x0--;
            $y0--;
        }
        
        $x1 = $slot;
        $y1 = $j;
        while($x1 + 1 < $this->width && $y1 + 1 < $this->height && $this->places[$x1 + 1][$y1 + 1] === $player) {
            $x1++;
            $y1++;
        }
        
        //echo "$x0, $y0 - $x1, $y1 </br>";
        
        // If max difference is 4 or more
        if($x1 - $x0 + 1 >= 4 ) {
            $this->row = [];
            for($i = 0; $i < 4; $i++) {
                $this->row[$i * 2] = $x0 + $i;
                $this->row[($i * 2) + 1] = $y0 + $i;
            }
            return true;
        }
        
        return false;
    }
    
    function print_contents() {
        foreach($this->places as $col) {
            foreach ($col as $elem) {
                echo "$elem    ";
            }
            echo '</br>';
        }
    }
    
    static function fromJson($json) {
        $obj = json_decode($json);
        $rtn = new self();
        
        $rtn->width = $obj->width;
        $rtn->height = $obj->height;
        $rtn->places = $obj->places;
        return $rtn;
    }
}

/*
$board = new Board();
$board->places[0] = [1, 1, 1, 1, 1, 1];
$board->places[1] = [1, 1, 1, 1, 1, 1];
$board->places[2] = [1, 1, 1, 1, 1, 1];
$board->places[3] = [1, 1, 0, 0, 0, 0];
$board->places[4] = [1, 1, 1, 0, 0, 0];
$board->places[5] = [1, 1, 1, 1, 1, 1];
$board->places[6] = [1, 1, 1, 1, 1, 1];

$board->checkWin(4);
echo json_encode($board->row);
*/
?>