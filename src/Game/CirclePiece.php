<?php

declare(strict_types = 1);

namespace Acme\TicTacToe\Game;

final class CirclePiece implements Piece
{
    public function __toString()
    {
        return 'O';
    }

}
