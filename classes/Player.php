<?php
declare(strict_types=1);

use JetBrains\PhpStorm\Pure;

class Player
{
    private bool $lost = false;

    protected const WIN_THRESHOLD = 21;

    /** @var Card[]  */
    private array $cards = [];

    public function __construct(Deck $deck) {
        for ($i = 0; $i <2 ; $i++) {
            $this->cards[] = $deck->drawCard();
        }
    }

    public function hit(Deck $deck) : void {
        $this->cards[] = $deck->drawCard();
        if ($this->getScore() > self::WIN_THRESHOLD) {
            $this->lost = true;
        }
    }

    public function surrender() : void {
        $this->lost = true;
    }

    #[Pure] public function getScore() : int {
        $score = 0;
        foreach($this->cards as $card) {
            $score += $card->getValue();
        }
        return $score;
    }

    public function hasLost() : bool {
        return $this->lost;
    }

    public function showMeTheMoney() : string {
        $money = "";
        foreach($this->cards as $card) {
             $money .= $card->getUnicodeCharacter(true) . " ";
        }
        return $money;
    }



}
