<?php

namespace Battleship\Board;

use Battleship\Board\Ship;
use Battleship\Board\BoardHelper;

class Board
{
    private $width;
    private $height;
    private $player;
    private $ships;
    private $shots;

    public function __construct($width, $height, $player)
    {
        $this->width = $width;
        $this->height = $height;
        $this->player = $player;
        $this->shots = [];
        $this->ships = BoardHelper::inititalizeBoard($width, $height);
    }

    public function fire($x, $y)
    {
        $this->shots[$x . '_' . $y] = true;
        foreach ($this->ships as $ship) {
            if ($ship->notifyShot($x, $y)) {
                return true;
            }
        }

        return false;
    }

    public function allSunk()
    {
        foreach ($this->ships as $ship) {
            if (!$ship->isSunk()) {
                return false;
            }
        }

        return true;
    }

    public function getHTML()
    {
        $container = '';
        for ($y=1; $y <= $this->height; $y++) {
            $row = [];
            for ($x=1; $x <= $this->width; $x++) {
                $row[$x] = $this->getCellHTML($x, $y, $this->player);
            }
            $container .= ('<tr><td>' . join('</td><td>', $row) . '</td></tr>');
        }
        return  '<table class="battlefield">' . $container . '</table>';
    }

    protected function getCellHTML($x, $y, $form = 'enemy')
    {
        foreach ($this->ships as $ship) {
            if ($ship->hasField($x, $y)) {
                return $ship->getHTML($x, $y, $form);
            }
        }

        if (array_key_exists($x . '_' . $y, $this->shots) || $this->allSunk()) {
            return '<div class="coordinate shot"></div>';
        }
        
        return '<button class="coordinate" type="submit" name="' . $form . '[' . $x  . '_' . $y . ']" value=""></button>';
    }
}
