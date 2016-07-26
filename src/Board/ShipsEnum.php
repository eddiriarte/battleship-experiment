<?php

namespace Battleship\Board;

class ShipsEnum
{
    private static $ship1 = [5, "Aircraft Carrier", 4];
    private static $ship2 = [4, "Battleship", 5];
    private static $ship3 = [3, "Destroyer", 6];
    private static $ship4 = [3, "Submarine", 7];
    private static $ship5 = [2, "Patrol Boat", 8];

    public static function AircraftCarrier()
    {
        return new Ship(self::$ship1[1], self::$ship1[0]);
    }

    public static function Battleship()
    {
        return new Ship(self::$ship2[1], self::$ship2[0]);
    }

    public static function Destroyer()
    {
        return new Ship(self::$ship3[1], self::$ship3[0]);
    }

    public static function Submarine()
    {
        return new Ship(self::$ship4[1], self::$ship4[0]);
    }

    public static function PatrolBoat()
    {
        return new Ship(self::$ship5[1], self::$ship5[0]);
    }

    public static function All()
    {
        return [
            self::AircraftCarrier(),
            self::Battleship(),
            self::Destroyer(),
            self::Submarine(),
            self::PatrolBoat(),
        ];
    }
}
