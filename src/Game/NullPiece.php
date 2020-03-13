<?php

declare(strict_types = 1);

namespace Acme\TicTacToe\Game;

final class NullPiece implements Piece
{
    public function __toString()
    {
        return ' ';
    }
}
