<?php

require_once('../vendor/autoload.php');

use RPSLS\Gesture;
use RPSLS\Match;
use RPSLS\Player;
use RPSLS\Turn;

// set up two computer players (integer $id, string $name, bool $AI)
$player1 = new Player(1, 'Bill', true);
$player2 = new Player(2, 'Ted', true);

// create new match with randomly selected gestures
$match = new Match(
    new Turn($player1, new Gesture(Gesture::getRandomGesture())),
    new Turn($player2, new Gesture(Gesture::getRandomGesture()))
);

// return winner of match as player ID, or 0 if DRAW
echo $match->getResult();