<?php
declare(strict_types=1);

class Dealer extends Player
{
    private const MIN_POINTS = 15;

    public function hit(Deck $deck) : void {
        if ($this->getScore() < self::MIN_POINTS) {
            parent::hit($deck);
        }
    }
}
