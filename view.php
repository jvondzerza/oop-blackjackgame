<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
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
            <div class="cards"><?php echo $blackJack->getPlayer()->showMeTheMoney(); ?></div>
            <p><?php echo $blackJack->getPlayer()->getScore(); ?></p>
        </section>
        <section id="dealer">
            <h3>Dealer</h3>
            <div class="cards"><?php echo $blackJack->getDealer()->showMeTheMoney(); ?></div>
            <p><?php echo $blackJack->getDealer()->getScore(); ?></p>
        </section>
        <section id="game-interface">
            <input type="submit" name="hit" value="hit">
            <input type="submit" name="stand" value="stand">
            <input type="submit" name="surrender" value="surrender">
        </section>
    </form>
</div>
</body>
</html>
