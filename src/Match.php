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

        $val = $gesture1['value'] - $gesture2['value'];
        $valMatch = ($val == 0);
        $parityMatch = ($gesture1['parity'] == $gesture2['parity']);
        $p1ValLower = ($val < 0);
        $p1ValHigher = ($val > 0);

        if ($valMatch) {
            return 0;
        }
        else if ($parityMatch) {
            if ($p1ValLower) {
                return $this->player1;
            } else {
                return $this->player2;
            }
        }
        else {
            if ($p1ValHigher) {
                return $this->player1;
            } else {
                return $this->player2;
            }
        }
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