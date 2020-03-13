<?php

declare(strict_types = 1);

namespace Acme\TicTacToe\Game;

final class Player
{
    private string $name;

    private Piece $piece;

    public function __construct(string $name, Piece $piece)
    {
        $this->name  = $name;
        $this->piece = $piece;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function piece(): Piece
    {
        return $this->piece;
    }
}
