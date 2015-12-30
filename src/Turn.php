<?php namespace RPSLS;

class Turn {
    protected $player;
    protected $gesture;

    /**
     * Turn constructor.
     * @param Player $player
     * @param Gesture $gesture
     */
    public function __construct(Player $player, Gesture $gesture) {
        $this->player = $player;
        $this->gesture = $gesture;
    }

    /**
     * @return Gesture
     */
    public function getGesture()
    {
        return $this->gesture;
    }

    /**
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }
}
