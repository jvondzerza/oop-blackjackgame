<?php
declare(strict_types=1);

require 'classes/Suit.php';
require 'classes/Card.php';
require 'classes/Deck.php';
require 'classes/Player.php';
require 'classes/Blackjack.php';
require 'classes/Dealer.php';

$player = "Player won.";
$dealer = "Dealer won.";
$whoWon = "";
const WIN_THRESHOLD = 21;
const MIN_POINTS = 15;

function whoWon ($winner = "Tied game.") : string {
    return $winner;
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

$playerScore = $blackJack->getPlayer()->getScore();
$dealerScore = $blackJack->getDealer()->getScore();

if ($playerScore === WIN_THRESHOLD) {
    $blackJack->getDealer()->surrender();
    if ($playerScore === $dealerScore) {
        $blackJack->getPlayer()->surrender();
    } else {
        $chips += 10;
    }
} else if ($dealerScore === WIN_THRESHOLD) {
    $blackJack->getPlayer()->surrender();
    $chips -= 5;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["hit"])) {
        $blackJack->getPlayer()->hit($blackJack->getDeck());
    }
    if (isset($_POST["stand"])) {
        $blackJack->getDealer()->hit($blackJack->getDeck());
        if ($dealerScore >= MIN_POINTS) {
            if ($dealerScore >= $playerScore) {
                $blackJack->getPlayer()->surrender();
            } else {
                $blackJack->getDealer()->surrender();
            }
        }
    }
    if (isset($_POST["surrender"])) {
        $blackJack->getPlayer()->surrender();
    }
    if (isset($_POST["bet"]) && !empty($_POST["bet"])) {
        $bet += $_POST["bet"];
        $chips -= $bet;
    }
}

if ($blackJack->getPlayer()->hasLost()) {
    if ($blackJack->getDealer()->hasLost()) {
        $whoWon = whoWon();
    } else {
        $whoWon = whoWon($dealer);
    }
} else if ($blackJack->getDealer()->hasLost()) {
    $whoWon = whoWon($player);
    if (isset($_SESSION["bet"])) {
        $chips += ($_SESSION["bet"] * 2);
    }
}

$_SESSION["bet"] = $bet;
$_SESSION["chips"] = $chips;
$_SESSION["blackJack"] = $blackJack;

if (!empty($whoWon)) {
    unset($_SESSION["blackJack"], $_SESSION["bet"]);
    refreshPage("3");
}

require 'view.php';