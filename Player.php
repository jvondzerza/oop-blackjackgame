<?php
declare(strict_types=1);

class Player
{
    private $lost = false;

    //
    private const WIN_THRESHOLD = 21;

    /** @var Card[]  */
    private $cards = [];

    public function __construct(Deck $deck) {
        for ($i = 0; $i <2 ; $i++) {
            $cards[] = $deck->drawCard();
        }
    }

    //what is hit doing?
    public function hit($deck) : Deck {
        $cards[] = $deck->drawCard();
        if ($this->getScore() > self::WIN_THRESHOLD) {
            $this->lost = true;
        }
    }
    public function surrender() : bool {
        $this->lost = true;
    }
    public function getScore() : int {
        $score = 0;
        foreach($this->cards as $card) {
            $score += $card->getValue();
        }
        return $score;
    }
    public function hasLost() : bool {
        return $this->lost;
    }



}
