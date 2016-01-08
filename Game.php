<?php
class Game {
    var $position;
    var $newposition;

    function __construct($squares = '---------')
    {
        $this->position = str_split($squares);
    }

    function winner($token) {
        //horizontals
        for($row=0; $row<3; $row++) {
            for($col=0; $col<3; $col++) {
                if ($this->position[3*$row+$col] != $token)
                    break;
                if ($col == 2) return true;
            }
        }
        //verticals
        for($col=0; $col<3; $col++) {
            for($row=0; $row<3; $row++) {
                if ($this->position[3*$row+$col] != $token)
                    break;
                if ($row == 2) return true;
            }
        }
        //diagonals
        if
        (
            (
                ($this->position[0] == $token) &&
                ($this->position[4] == $token) &&
                ($this->position[8] == $token)
            )
            ||
            (
                ($this->position[2] == $token) &&
                ($this->position[4] == $token) &&
                ($this->position[6] == $token)
            )
        )
            return true;
        return false;
    }

    function display() {
        echo '<div class="container"><table class="table table-bordered table-responsive text-center">';
        echo '<tr>'; // open the first row
        for ($pos=0; $pos<9;$pos++) {
            echo $this->show_cell($pos);
            if ($pos %3 == 2) echo '</tr><tr>'; // start a new row for the next square
        }
        echo '</tr>'; // close the last row
        echo '</table></div>';
    }

    function show_cell($which) {
        $token = $this->position[$which];
        $c = ($token == 'x') ? 'rgba(255,0,0,0.4)' : 'rgba(0,255,0,0.4)';
        // deal with the easy case
        if ($token <> '-') return "<td style='background-color:$c'>".$token.'</td>';
        // now the hard case
        $this->newposition = $this->position; // copy the original
        $this->newposition[$which] = 'o'; // this would be their move
        $move = implode($this->newposition); // make a string from the board array
        $link = '?board='.$move; // this is what we want the link to be
        // so return a cell containing an anchor and showing a hyphen
        return '<td><a href="'.$link.'">-</a></td>';
    }

    function pick_move(){
        $options = array();
        $x = $o = 0;
        for($row=0; $row<3; $row++)
            for($col=0; $col<3; $col++)
            {
                if ($this->position[3*$row+$col] == 'x')
                    $x++;
                else if ($this->position[3*$row+$col] == 'o')
                    $o++;
                else
                    array_push($options, 3*$row+$col);
            }

        if (empty($options))
            echo "<i>The game ended in a tie, please press replay.</i>";

        if ( $x <= $o )
        {
            $choice = rand(1, sizeof($options));
            $this->position[$options[$choice-1]] = 'x';

            if (sizeof($options) == 1)
                if (!$this->winner('x'))
                    die("The game was tie :(<br><hr><a class=\"btn btn-default\" role=\"button\" onclick=\"window.location.assign('index.php')\">Replay</a>");
        }
    }


}