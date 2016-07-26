<?php

namespace Battleship\AI;

interface Intelligence
{
    public function shot();

    public function notify($coordinate, $isHit);
}
