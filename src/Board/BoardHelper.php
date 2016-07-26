<?php

namespace Battleship\Board;

use Battleship\Board\Ship;
use Battleship\Board\ShipsEnum;

class BoardHelper
{
    public static function inititalizeBoard($width, $height)
    {
        $fields = [];
        $ships = ShipsEnum::All();
        $size = ['x' => $width, 'y' => $height];
        
        foreach ($ships as $ship) {
            $position = self::randomShipPosition($ship, $size, $fields);
            for ($i=0; $i < $ship->getSize(); $i++) {
                $x = $position['is_vertical'] ? $position['x'] : $position['x'] + $i;
                $y = $position['is_vertical'] ? $position['y'] + $i : $position['y'];

                $ship->addField($x, $y);
            }
            
            $fields = array_merge($fields, $ship->getFields());
        }
        
        return $ships;
    }

    public static function isOnBounds($x, $y, $size)
    {
        return ($x > 0 && $x <= $size['x']) && ($y > 0 && $y <= $size['y']);
    }

    public static function isFreeField($x, $y, $fields)
    {
        return !isset($fields[$x . '_' . $y]);
    }

    public static function randomShipPosition($ship, $size, $fields)
    {
        $length = $ship->getSize();
        $position = [];
        while (count($position) < 3) {
            $randomX = rand(1, $size['x']);
            $randomY = rand(1, $size['y']);
            $isVertical = (rand(1, 99) % 2 == 0);
            
            for ($i=0; $i < $length; $i++) {
                $x = $isVertical ? $randomX : $randomX + $i;
                $y = $isVertical ? $randomY + $i : $randomY;

                if (!self::isOnBounds($x, $y, $size)
                    || !self::isFreeField($x-1, $y, $fields)
                    || !self::isFreeField($x+1, $y, $fields)
                    || !self::isFreeField($x, $y-1, $fields)
                    || !self::isFreeField($x, $y+1, $fields)
                    || !self::isFreeField($x-1, $y-1, $fields)
                    || !self::isFreeField($x+1, $y+1, $fields)
                    || !self::isFreeField($x+1, $y-1, $fields)
                    || !self::isFreeField($x-1, $y+1, $fields)) {
                    break;
                }

                if ($i == ($length-1)) {
                    $position = [ 'x' => $randomX, 'y' => $randomY, 'is_vertical' => $isVertical ];
                }
            }
        }

        return $position;
    }
}
