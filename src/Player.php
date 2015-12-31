<?php namespace RPSLS;

class PlayerException extends \Exception {}

class Player
{
    protected $playerID;
    protected $playerName;
    protected $AI;

    /**
     * Name player and specify whether human (default)
     * or artificial (semi-)intelligence.
     *
     * @param $playerName
     * @param bool $AI
     */
    function __construct($playerID, $playerName, $AI = false)
    {
        $this->playerID = (integer) $playerID;
        $this->playerName = (string) $playerName;
        $this->AI = (bool) $AI;
    }

    /**
     * @return string
     */
    public function getPlayerName()
    {
        return $this->playerName;
    }

    /**
     * @return boolean
     */
    public function isAI()
    {
        return $this->AI;
    }

    /**
     * @return integer
     */
    public function getPlayerID()
    {
        return $this->playerID;
    }

    public function __toString()
    {
        return $this->playerName;
    }
}