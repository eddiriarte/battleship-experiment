<?php

namespace Battleship;

use Battleship\AI\ArtificialIntelligence;
use Battleship\Board\Board;

/**
 * 
 */
class Game
{
    private $state;
    private $ai;
    private $player;
    private $enemy;
    private $messages;
    
    public function __construct($identifier, $width = 10, $height = 10, $level = 1)
    {
        $this->state = 'play';
        $this->level = $level;
        $this->ai = ArtificialIntelligence::build($this->level, $width, $height);
        $this->player = new Board($width, $height, 'player');
        $this->enemy = new Board($width, $height, 'enemy');
        $this->messages = [ 0 => [ "Game \'$identifier\' has been created." ] ];
    }

    public function getHTML()
    {
        return '<div id="player" class="col-md-6"><h4>PLAYER</h4>' . $this->player->getHTML() . '</div>'
        . '<div id="enemy" class="col-md-6"><h4>ENEMY</h4>' . $this->enemy->getHTML() . '</div>';
    }

    public function getMessages($index = false)
    {
        $index = $index?: count($this->messages)-1;

        return $this->messages[$index];
    }

    private function appendMessage($message, $index = false)
    {
        $index = $index?: count($this->messages)-1;

        if (!array_key_exists($index, $this->messages)) {
            $this->messages[$index] = [];
        }

        $this->messages[$index][] = $message;
    }

    public function playerShot($x, $y)
    {
        $hasNextTurn = $this->enemy->fire($x, $y);
        $this->appendMessage("Player has shot to: [$x,$y]. " . ($hasNextTurn ? "SUCCESS" : "FAILURE"), count($this->messages));

        if ($this->enemy->allSunk()) {
            $this->appendMessage("Player has won!");
            return $this->playerWins();
        }

        if ($hasNextTurn) {
            return $this->nextPlayer();
        }
        
        $enemyHasNextTurn = true;
        while ($enemyHasNextTurn) {
            $shot = $this->ai->shot();
            $wasHit = $this->player->fire($shot['x'], $shot['y']);
            $this->ai->notify($shot, $wasHit);
            $enemyHasNextTurn = $wasHit;

            $this->appendMessage("Enemy has shot to: [$x,$y]. " . ($enemyHasNextTurn ? "SUCCESS" : "FAILURE"));
            
            if ($this->player->allSunk()) {
                $this->appendMessage("Enemy has won!");
                return $this->enemyWins();
            }
        }
        

        return $this->nextPlayer();
    }

    

    public function playerWins()
    {
        # code...
    }

    public function enemyWins()
    {
        # code...
    }

    public function nextPlayer()
    {
        # code...
    }
}
