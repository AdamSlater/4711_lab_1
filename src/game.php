<?php
class Game {

    var $position;

    function __construct($squares)
    {
        $this->position = str_split($squares);
    }

    function winner($token,$position) {
        $won = false;
        if
        (
            ($position[0] == $token) &&
            ($position[1] == $token) &&
            ($position[2] == $token)
        )
            $won = true;
        else if
        (
            ($position[3] == $token) &&
            ($position[4] == $token) &&
            ($position[5] == $token)
        )
            $won = true;
        return $won;
    }

}