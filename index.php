<?php
function winner($token,$position) {
    for($row=0; $row<3; $row++) { //horizontals
        for($col=0; $col<3; $col++) {
            if ($position[3*$row+$col] != $token)
                break;
            if ($col == 2) return true;
        }
    }
    for($col=0; $col<3; $col++) { //verticals
        for($row=0; $row<3; $row++) {
            if ($position[3*$col+$row] != $token)
                break;
            if ($row == 2) return true;
        }
    }
    //diagonals
    if
    (
        (
            ($position[0] == $token) &&
            ($position[4] == $token) &&
            ($position[8] == $token)
        )
        ||
        (
            ($position[2] == $token) &&
            ($position[4] == $token) &&
            ($position[6] == $token)
        )
    )
        return true;
    return false;
}
?>
<html>
    <head>
        <title>Hello</title>
    </head>
    <body>
    <?php
    $position = $_GET['board'];
    $squares = str_split($position);

    if (isset($_GET['board']))
    {
        if (winner('x', $squares))
            echo 'You win, x';
        else if (winner('o', $squares))
            echo 'I win, o';
        else echo 'No winner yet.';
    }
    ?>
    </body>
</html>