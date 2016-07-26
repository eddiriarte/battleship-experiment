<?php

namespace Battleship\AI;

use Battleship\AI\Intelligence;

class EasyIntelligence implements Intelligence
{
    private $hits;
    private $shots;
    private $width;
    private $height;

    public function __construct($width = 10, $height = 10)
    {
        $this->hits = [];
        $this->shots = [];
        $this->width = $width;
        $this->height = $height;
    }

    public function shot()
    {
        $x = rand(1, $this->width);
        $y = rand(1, $this->height);

        if (!array_key_exists($x . '_' . $y, $this->shots)) {
            $this->shots[$x . '_' . $y] = true;
            return ['x' => $x, 'y' => $y];
        }

        return $this->shot();
    }

    public function notify($coordinate, $isHit)
    {
        if ($isHit) {
            $this->hits[$coordinate['x'] . '_' . $coordinate['y']] = true;
        }
    }
}
