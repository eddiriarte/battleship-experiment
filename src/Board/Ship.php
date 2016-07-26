<?php

namespace Battleship\Board;

class Ship
{
    private $type;
    private $size;
    private $symbol;
    private $fields;
    private $hits;

    public function __construct($type, $size, $symbol = null)
    {
        $this->type = $type;
        $this->size = $size;
        $this->symbol = $symbol;
        $this->hits = [];
        $this->fields = [];
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function hasField($x, $y)
    {
        return array_key_exists($x . '_' . $y, $this->fields);
    }

    public function getHits()
    {
        return $this->hits;
    }

    public function addField($x, $y)
    {
        $this->fields[$x . '_' . $y] = true;
    }

    public function isHit($x, $y)
    {
        return array_key_exists($x . '_' . $y, $this->hits);
    }

    public function isSunk()
    {
        return count($this->fields) == count($this->hits);
    }

    public function notifyShot($x, $y)
    {
        $isHit = $this->hasField($x, $y);
        if ($isHit) {
            $this->hits[$x . '_' . $y] = true;
        }

        return $isHit;
    }

    public function getHTML($x, $y, $form = 'enemy')
    {
        $classes = ["coordinate"];

        if ($this->isHit($x, $y)) {
            array_push($classes, "ship", "shot");
            return '<div class="coordinate ship shot"></div>';
        }

        if ($this->isSunk()) {
            array_push($classes, "ship-" . $this->symbol, "sunk");
            return '<div class="' . join(' ', $classes) . '"></div>';
        }

        $classes[] = $form == 'enemy' ? '' : 'ship';
        return '<button class="' . join(' ', $classes) . '" type="submit" name="' . $form . '[' . $x . '_' . $y . ']" />';
    }
}
