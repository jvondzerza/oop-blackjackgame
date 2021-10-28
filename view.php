<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div id="game">
    <form method="post">
        <section id="player">
            <div><?php echo $_SESSION["blackJack"]->getPlayer()->showMeTheMoney(); ?></div>
            <div><?php echo $_SESSION["blackJack"]->getPlayer()->getScore(); ?></div>
        </section>
        <section id="dealer">
            <div><?php echo $_SESSION["blackJack"]->getDealer()->showMeTheMoney(); ?></div>
            <div><?php echo $_SESSION["blackJack"]->getDealer()->getScore(); ?></div>
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
