<?php
declare(strict_types=1);

require 'Suit.php';
require 'Card.php';
require 'Deck.php';
require 'Player.php';
require 'Blackjack.php';
require 'Dealer.php';

session_start();

if (!isset($_SESSION["blackJack"])) {
    $blackJack = new Blackjack();
    $_SESSION["blackJack"] = $blackJack;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["hit"]) {
        $_SESSION["blackJack"]->getPlayer()->hit($_SESSION["blackJack"]->getDeck());
        return $_SESSION["blackJack"]->getPlayer()->hasLost();
    }
    if ($_POST["stand"]) {
        $_SESSION["blackJack"]->getDealer()->hit($_SESSION["blackJack"]->getDeck());
    }
    if ($_POST["surrender"]) {
        $_SESSION["blackJack"]->getPlayer()->surrender();
    }
}

/*$deck = new Deck();
$deck->shuffle();

$test = $deck->drawCard();
echo $test->getUnicodeCharacter(true);

foreach($deck->getCards() AS $card) {
    echo $card->getUnicodeCharacter(true);
    echo '<br>';
}*/

require 'view.php';