<?php

namespace Battleship\Board;

use PHPUnit\Framework\TestCase;
use Battleship\Board\Ship;

class ShipTest extends TestCase
{

    public function testInitialization()
    {
        $boat = new Ship("Little Boat", 2, "LB");
        
        // Assert
        $this->assertEquals(2, $boat->getSize());
        $this->assertEquals([], $boat->getFields());
        $this->assertEquals([], $boat->getHits());
    }

    public function testAddField()
    {
        $boat = new Ship("Little Boat", 2, "LB");

        $boat->addField(4, 4);
        $boat->addField(4, 5);

        // Assert
        $this->assertEquals(2, count($boat->getFields()));
        $this->assertEquals(true, $boat->hasField(4, 4));
        $this->assertEquals(true, $boat->hasField(4, 5));
    }

    public function testNotifyShot()
    {
        $boat = new Ship("Little Boat", 2, "LB");

        $boat->addField(4, 4);
        $boat->addField(4, 5);

        $shot1 = $boat->notifyShot(4, 5);
        $shot2 = $boat->notifyShot(4, 6);

        // Assert
        $this->assertEquals(true, $shot1);
        $this->assertEquals(false, $shot2);
        $this->assertEquals(1, count($boat->getHits()));
        $this->assertEquals(false, $boat->isSunk());
    }
}
