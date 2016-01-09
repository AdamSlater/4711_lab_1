<html>
    <head>
        <title>Tic Tac Toe</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" crossorigin="anonymous">
        <!-- Custom Game Styling -->
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
            require_once 'game.php';    // includes the game class, and its methods
            ob_start();                 // buffers output

            if ( isset($_GET['board']) ) // if there's board that's currently
            {
                $board = $_GET['board'];
                if ( !preg_match( "/[xo-]{9}/", $board ) ) //primitive check to see that the game only contains 9 of x,o,-
                    die( "Invalid game in progress" );

                echo "<header class='page-header'><h1>Game in progress...<br>";
                $game = new Game( $_GET['board'] );
            }
            else
            {
                echo "<header class='page-header'><h1>New game<br>";
                $game = new Game(); //creates a new game, default: --------- all empty
            }

            if ( $game->winner('o' ))      // user wins
                echo "<small>You win. Lucky guesses!</small></h1></header>";
            else if ( $game->winner('x') ) // ai wins
                echo "<small>I win. Muahahahaha</small></h1></header>";
            else
            {
                $game->pick_move();       // ai makes a move
                if ( $game->winner('x') ) // checks to see if that caused ai to win
                    echo "<small>I win. Muahahahaha</small></h1></header>";
                else
                {
                    echo "<small>No winner yet, but you are losing.</small></h1></header>";
                    $game->display();    // actually prints the game board for user to make a move
                }
            }

            ob_end_flush();             // flushes output
        ?>

        <br><hr>
        <!-- Refresh index page, to replay -->
         <a class="btn btn-default" role="button" onclick="window.location.assign('index.php')">Replay</a>
    </body>
</html>
