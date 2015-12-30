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
        /* do not allow '0' as player id, as this
           interferes with match result for DRAWs */
        if((integer) $playerID == 0) {
            throw new PlayerException('Player ID must be integer and may not be 0.');
        }
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
}