<?php

namespace Battleship\AI;

use Battleship\AI\EasyIntelligence;

class ArtificialIntelligence
{
    const LEVEL_EASY = 0;
    const LEVEL_DEFAULT = 0;

    public static function build($level, $width, $height)
    {
        switch ($level) {
            case 0:
            default:
                return new EasyIntelligence($width, $height);
                break;
        }
    }
}
