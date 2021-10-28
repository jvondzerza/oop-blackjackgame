<?php
declare(strict_types=1);

require 'Suit.php';
require 'Card.php';
require 'Deck.php';
require 'Player.php';
require 'Blackjack.php';

session_start();

$blackJack = new Blackjack();
$_SESSION["blackJack"] = $blackJack;


/*$deck = new Deck();
$deck->shuffle();

$test = $deck->drawCard();
echo $test->getUnicodeCharacter(true);

foreach($deck->getCards() AS $card) {
    echo $card->getUnicodeCharacter(true);
    echo '<br>';
}*/

require 'view.php';