<?php

namespace Battleship\Board;

use Battleship\Twig\TemplateManager;

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

    public function isFirst($x, $y)
    {
        $list = array_keys($this->fields);
        if (array_search($x . '_' . $y, $list) === 0) {
            return true;
        }
        
        return false;
    }

    public function isLast($x, $y)
    {
        $list = array_keys($this->fields);
        if (array_search($x . '_' . $y, $list) === (count($list) - 1)) {
            return true;
        }
        
        return false;
    }

    public function isVertical()
    {
        $list = array_keys($this->fields);
        $first = explode('_', $list[0]);
        $last = explode('_', $list[count($list)-1]);

        // is vertical
        return $first[0] == $last[0] && $first[1] != $last[1];
    }



    public function notifyShot($x, $y)
    {
        $isHit = $this->hasField($x, $y);
        if ($isHit) {
            $this->hits[$x . '_' . $y] = true;
        }

        return $isHit;
    }

    public function render($x, $y, $form = 'enemy')
    {
        return TemplateManager::instance()->render('ship-tile.twig.html', [
            'isClickable' => $form == 'enemy' && !$this->isHit($x, $y),
            'isVisible' => $form != 'enemy' || $this->isSunk(),
            'isFirst' => $this->isFirst($x, $y),
            'isLast' => $this->isLast($x, $y),
            'isVertical' => $this->isVertical(),
            'isHit' => $this->isHit($x, $y),
            'collection' => $form,
            'name' => $x . '_' . $y,
            'x' => $x,
            'y' => $y,
        ]);
    }
}
