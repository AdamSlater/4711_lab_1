<html>
    <head>
        <title>Tic Tac Toe</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <?php
    require_once 'Game.php';

    if (isset($_GET['board']))
    {
        echo "Game in progress<br>";
        $game = new Game($_GET['board']);
    }
    else
    {
        echo "Creating new game<br>";
        $game = new Game();
    }

    $game->pick_move();
    $game->display();

    if ($game->winner('x'))
        echo 'You win. Lucky guesses!';
    else if ($game->winner('o'))
        echo 'I win. Muahahahaha';
    else
        echo 'No winner yet, but you are losing.';
    ?>
    <br><hr>
    <a onclick="window.location.assign('index.php')">Replay</a>
    </body>
</html>