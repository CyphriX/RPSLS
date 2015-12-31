<?php

require_once('../vendor/autoload.php');

use RPSLS\Player;
use RPSLS\Turn;
use RPSLS\Gesture;
use RPSLS\Match;

$player1 = new Player(1, 'Jason', true);
$player2 = new Player(2, 'Computer', true);

$match = new Match(
    new Turn($player1, new Gesture(Gesture::getRandomGesture())),
    new Turn($player2, new Gesture(Gesture::getRandomGesture()))
);

echo "And the winner is... " . $match->getWinner();

?>

