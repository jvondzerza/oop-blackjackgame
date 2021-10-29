<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
echo '<h2>' . $whoWon . '</h2>';
?>
<div id="game">
    <form method="post">
        <section id="player">
            <h3>Player</h3>
            <div class="cards animate__animated animate__fadeIn">
                <h1><?php echo $blackJack->getPlayer()->showMeTheMoney(); ?></h1>
            </div>
            <h4>Score: <?php echo $blackJack->getPlayer()->getScore(); ?></h4>
            <h4 class="bottom-of-card">Chip count: <?php echo $chips; ?></h4>
        </section>
        <section id="dealer">
            <h3>Dealer</h3>
            <div class="cards animate__animated animate__fadeIn">
                <h1><?php echo $blackJack->getDealer()->showMeTheMoney(); ?></h1>
            </div>
            <h4 class="bottom-of-card">Score: <?php echo $blackJack->getDealer()->getScore(); ?></h4>
        </section>
        <section id="game-interface">
            <input type="submit" name="hit" value="Hit">
            <input type="submit" name="stand" value="Stand">
            <input type="submit" name="surrender" value="Surrender">
            <label for="game-interface">Bet: </label>
            <input id="bet" type="number" name="bet" value="" min="5">
        </section>
    </form>
</div>
</body>
</html>
