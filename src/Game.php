<?php

namespace Battleship;

use Battleship\AI\ArtificialIntelligence;
use Battleship\Board\Board;
use Battleship\Info\Message;
use Battleship\Twig\TemplateManager;

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
        $this->messages = [ 0 => [ new Message("Game '$identifier' has been created.") ] ];
    }

    public function render()
    {
        return TemplateManager::instance()->render('game.twig.html', [
            'messages' => $this->getMessages(),
            'enemy' => $this->enemy,
            'player' => $this->player,
        ]);
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
        $msg = new Message("Player has shot to: " . chr(64+$y) . "-$x." . ($hasNextTurn ? " It was a hit!" : ""), $hasNextTurn ? "success" : "error");
        $this->appendMessage($msg, count($this->messages));

        if ($this->enemy->allSunk()) {
            $this->appendMessage(new Message("Player has won!", 'success'));
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

            $msg = new Message("Enemy has shot to: " . chr(64+$shot['y']) . "-" . $shot['x'] . "." . ($enemyHasNextTurn ? " It was a hit!" : ""), $enemyHasNextTurn ? "error" : "info");
            $this->appendMessage($msg);
            
            if ($this->player->allSunk()) {
                $this->appendMessage(new Message("Enemy has won!", "error"));
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
