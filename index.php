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

function whoWon ($winner) : string {
    return $winner . " won.";
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

if (isset($_SESSION["chips"]) && !empty($_SESSION["chips"])) {
    $chips = $_SESSION["chips"];
} else {
    $chips = 100;
}

if (isset($_SESSION["bet"]) && !empty($_SESSION["bet"])) {
    $bet = $_SESSION["bet"];
} else {
    $bet = 0;
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
    if (isset($_POST["bet"]) && !empty($_POST["bet"])) {
        $bet = $_POST["bet"];
        $_SESSION["bet"] += $bet;
        $chips -= $bet;
    }
}

if ($blackJack->getPlayer()->hasLost()) {
    $whoWon = whoWon($dealer);
} else if ($blackJack->getDealer()->hasLost()) {
    $whoWon = whoWon($player);
    $chips += ($_SESSION["bet"] * 2);
}

$_SESSION["chips"] = $chips;
$_SESSION["blackJack"] = $blackJack;

if (!empty($whoWon)) {
    unset($_SESSION["blackJack"], $_SESSION["bet"]);
    refreshPage("3");
}

/*$deck = new Deck();
$deck->shuffle();

foreach($deck->getCards() AS $card) {
    echo $card->getUnicodeCharacter(true);
    echo '<br>';
}*/

require 'view.php';