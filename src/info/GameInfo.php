<?php
class GameInfo {
    public $width;
    public $height;
    public $strategies;
    
    function __construct($width, $height, $strategies) {
        $this->width = $width;
        $this->height = $height;
        $this->strategies = $strategies;
    }
}
?>