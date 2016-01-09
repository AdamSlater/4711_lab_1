<html>
    <head>
        <title>Tic Tac Toe</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" crossorigin="anonymous">
        <style>
            h1, small {
                text-align: center;
            }
            a:not(btn) {
               color: #336fff;
            }
            a.btn {
                width: 30%;
                margin: 0 auto;
                display: block;
            }
            a:hover {
                text-decoration: none;
            }
            table {
                font-weight: bold;
                font-size: x-large;
                background-color: rgba(120,120,120,0.15);
            }
        </style>
    </head>
    <body>
        <?php
            require_once 'game.php';
            ob_start();

            if (isset($_GET['board']))
            {
                $board = $_GET['board'];
                if ( !preg_match("/[xo-]{9}/", $board) )
                    die("Invalid game in progress");

                echo "<header class='page-header'><h1>Game in progress...<br>";
                $game = new Game($_GET['board']);
            }
            else
            {
                echo "<header class='page-header'><h1>New game<br>";
                $game = new Game();
            }

            if ($game->winner('o'))
                echo "<small>You win. Lucky guesses!</small></h1></header>";
            else if ($game->winner('x'))
                echo "<small>I win. Muahahahaha</small></h1></header>";
            else
            {
                $game->pick_move();
                if ($game->winner('x'))
                    echo "<small>I win. Muahahahaha</small></h1></header>";
                else
                {
                    echo "<small>No winner yet, but you are losing.</small></h1></header>";
                    $game->display();
                }
            }

            ob_end_flush();
        ?>

        <br><hr>
         <a class="btn btn-default" role="button" onclick="window.location.assign('index.php')">Replay</a>
    </body>
</html>