<?php

namespace Battleship\Board;

use Battleship\Board\Ship;
use Battleship\Board\BoardHelper;
use Battleship\Twig\TemplateManager;

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

    public function getHeight()
    {
        return $this->height;
    }

    public function getWidth()
    {
        return $this->width;
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

    public function hasShipAt($x, $y)
    {
        foreach ($this->ships as $ship) {
            if ($ship->hasField($x, $y)) {
                return true;
            }
        }

        return false;
    }

    public function getShipAt($x, $y)
    {
        foreach ($this->ships as $ship) {
            if ($ship->hasField($x, $y)) {
                return $ship;
            }
        }

        return false;
    }

    public function hasShotAt($x, $y)
    {
        return array_key_exists($x . '_' . $y, $this->shots);
    }

    public function rowName($number)
    {
        return chr(64 + $number);
    }

    public function render()
    {
        return  TemplateManager::instance()->render('board.twig.html', [
            'board' => $this
        ]);
    }

    public function renderCell($x, $y, $form = 'enemy')
    {
        if ($this->hasShipAt($x, $y)) {
            return $this->getShipAt($x, $y)->render($x, $y, $this->player);
        }

        return  TemplateManager::instance()->render('field-tile.twig.html', [
            'isClickable' => $this->player == 'enemy' && !$this->hasShotAt($x, $y) && !$this->allSunk(),
            'isHit' => $this->hasShotAt($x, $y),
            'collection' => $this->player,
            'name' => $x . '_' . $y,
            'x' => $x,
            'y' => $y,
        ]);
    }
}
