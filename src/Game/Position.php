<?php

declare(strict_types = 1);

namespace Acme\TicTacToe\Game;

final class Position
{
    private int $row;
    private int $column;

    public function __construct(int $row, int $column)
    {
        if ($row < 1 || $column < 1) {
            throw new \InvalidArgumentException('Invalid position');
        }

        $this->row    = $row;
        $this->column = $column;
    }

    public function row(): int
    {
        return $this->row;
    }

    public function column(): int
    {
        return $this->column;
    }
}
