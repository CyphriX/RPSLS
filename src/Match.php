<?php namespace RPSLS;

class MatchException extends \Exception
{
}

class Match
{
    protected $turn1;
    protected $turn2;
    protected $winner;

    /**
     * Match constructor.
     * @param Turn $turn1
     * @param Turn $turn2
     */
    public function __construct($turn1, $turn2)
    {
        $this->turn1 = $turn1;
        $this->turn2 = $turn2;
        $this->player1 = $turn1->getPlayer();
        $this->player2 = $turn2->getPlayer();

        if ($this->player1->getPlayerID() == $this->player2->getPlayerID()) {
            throw new MatchException('Must use two different players');
        }
        $this->winner = $this->getWinner();
        $this->loser = $this->getLoser();
        return $this;
    }

    /**
     * Get the winner of the match.
     * @return Player
     */
    public function getWinner() {
        $gestures = $this->getGestures();
        $gesture1 = $gestures[0];
        $gesture2 = $gestures[1];

        // determine which value is higher, or if they match
        $val = $gesture1['value'] - $gesture2['value'];
        $p1ValLower = ($val < 0);
        $p1ValHigher = ($val > 0);
        $valMatch = ($val == 0);
        // determine if parity match [even, even] or [odd, odd]
        $parityMatch = ($gesture1['parity'] == $gesture2['parity']);

        if ($valMatch) {
            // values match. DRAW
            $winner = 0;
        }
        else if ($parityMatch) {
            // parity match - lowest value wins
            if ($p1ValLower) {
                $winner = $this->player1;
            } else {
                $winner = $this->player2;
            }
        }
        else {
            // parity mismatch - highest value wins
            if ($p1ValHigher) {
                $winner = $this->player1;
            } else {
                $winner = $this->player2;
            }
        }
        $this->winner = $winner;
        return $winner;
    }

    public function getLoser() {
        // check for draw
        if (!$this->winner instanceof Player) {
            $loser = 0;
        }
        // determine who isn't the winner... AKA the loser
        else if ($this->winner->getPlayerID() != $this->player1->getPlayerID()) {
            $loser = $this->player1;
        } else {
            $loser = $this->player2;
        }
        return $loser;
    }

    /**
     * @return array
     */
    protected function getGestures() {
        $gesture1 = $this->turn1->getGesture();
        $gesture2 = $this->turn2->getGesture();

        return [
          [
              'name' => $gesture1->getName(),
              'value' => $gesture1->getValue(),
              'parity' => $gesture1->getParity()
          ],
          [
              'name' => $gesture2->getName(),
              'value' => $gesture2->getValue(),
              'parity' => $gesture2->getParity()
          ]
        ];
    }

}