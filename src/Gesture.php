<?php namespace RPSLS;

class GestureException extends \Exception
{
}

class Gesture
{
    const ROCK = 'ROCK';
    const PAPER = 'PAPER';
    const SCISSORS = 'SCISSORS';
    const SPOCK = 'SPOCK';
    const LIZARD = 'LIZARD';

    protected static $gestures = [
        'ROCK' => [1, 'ODD'],
        'PAPER' => [2, 'EVEN'],
        'SCISSORS' => [3, 'ODD'],
        'SPOCK' => [4, 'EVEN'],
        'LIZARD' => [5, 'ODD']
    ];

    protected $name;
    protected $value;
    protected $parity;

    public function __construct($gesture)
    {
        if (array_key_exists($gesture, static::$gestures)) {
            $this->name = $gesture;
            $this->value = static::$gestures[$gesture][0];
            $this->parity = static::$gestures[$gesture][1];
        } else {
            throw new GestureException('Invalid gesture provided');
        }
    }

    public static function getRandomGesture() {
        $keys = array_keys(static::$gestures);
        $key = rand(0, count($keys) - 1);
        return $keys[$key];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getParity()
    {
        return $this->parity;
    }

}