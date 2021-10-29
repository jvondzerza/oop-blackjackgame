<?php
declare(strict_types=1);

require 'Suit.php';
require 'Card.php';
require 'Deck.php';
require 'Player.php';
require 'Blackjack.php';
require 'Dealer.php';

$player = "Player";
$dealer = "Dealer";
$whoWon = "";

function whoWon ($winner, $loser) : string {
    return $winner . " won! " . $loser . " lost :'(.";
}

function refreshPage ($sec) : void {
    $page = $_SERVER['PHP_SELF'];
    header("Refresh: $sec; url=$page");
}

session_start();

if (isset($_SESSION["blackJack"]) && !empty($_SESSION["blackJack"])) {
    $blackJack = $_SESSION["blackJack"];
} else {
    $blackJack = new Blackjack();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["hit"])) {
        $blackJack->getPlayer()->hit($blackJack->getDeck());
    }
    if (isset($_POST["stand"])) {
        $blackJack->getDealer()->hit($blackJack->getDeck());
        $playerScore = $blackJack->getPlayer()->getScore();
        $dealerScore = $blackJack->getDealer()->getScore();
        if ($playerScore > $dealerScore) {
            $blackJack->getDealer()->surrender();
        } else {
           $blackJack->getPlayer()->surrender();
        }
    }
    if (isset($_POST["surrender"])) {
        $blackJack->getPlayer()->surrender();
    }
}

if ($blackJack->getPlayer()->hasLost()) {
    $whoWon = whoWon($dealer, $player);
} else if ($blackJack->getDealer()->hasLost()) {
    $whoWon = whoWon($player, $dealer);
}

$_SESSION["blackJack"] = $blackJack;

if (!empty($whoWon)) {
    session_unset();
    refreshPage("2");
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