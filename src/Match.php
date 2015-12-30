<?php namespace RPSLS;

class MatchException extends \Exception
{
}

class Match
{
    protected $turn1 = null;
    protected $turn2 = null;

    /**
     * Match constructor.
     * @param Turn $turn1
     * @param Turn $turn2
     */
    public function __construct($turn1, $turn2)
    {
        $this->turn1 = $turn1;
        $this->turn2 = $turn2;
        $this->player1 = $turn1->getPlayer()->getPlayerID();
        $this->player2 = $turn2->getPlayer()->getPlayerID();

        if ($this->player1 == $this->player2) {
            throw new MatchException('Must use two different players');
        }
        return $this;
    }

    /**
     * Get the results of the match.
     * @return integer
     */
    public function getResult()
    {
        $gesture1 = $this->turn1->getGesture();
        $gesture2 = $this->turn2->getGesture();
        $player1id = $this->player1;
        $player2id = $this->player2;

        // subtract value 2 from value 1 to determine which (if any) is higher
        $val = $gesture1->getValue() - $gesture2->getValue();
        // check to see if both even, or both odd
        $parityMatch = $gesture1->getParity() == $gesture2->getParity();

        // here comes all the fun game logic... SPOCK will be pleased
        if ($val == 0) {
            // values are identical - DRAW
            return 0;
        } elseif ($parityMatch) {
            // parity matches ([even, even] or [odd, odd])
            if ($val < 0) {
                // player 1 value lower - player 1 wins
                return $player1id;
            } else {
                // player 2 value lower - player 2 wins
                return $player2id;
            }
        } else {
            // parity does not match ([even, odd] or [odd, even])
            if ($val > 0) {
                // player 1 value higher - player 1 wins
                return $player1id;
            } else {
                // player 2 value higher - player 2 wins
                return $player2id;
            }
        }
    }

}