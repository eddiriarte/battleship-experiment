<?php


namespace Battleship\Info;

/**
 * 
 */
class Message
{
    private $message;
    private $context;
    private $type;

    public function __construct($message, $type = 'info', $context = 'global')
    {
        $this->message = $message;
        $this->context = $context;
        $this->type = $type;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getType()
    {
        return $this->type;
    }
}
