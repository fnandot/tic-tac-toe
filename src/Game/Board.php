<?php

declare(strict_types = 1);

namespace Acme\TicTacToe\Game;

use InvalidArgumentException;

final class Board
{
    private array $value;

    private function __construct(array $value)
    {
        $this->value = $value;
    }

    public static function initialize(): self
    {
        return new static(
            [
                [new NullPiece(), new NullPiece(), new NullPiece()],
                [new NullPiece(), new NullPiece(), new NullPiece()],
                [new NullPiece(), new NullPiece(), new NullPiece()],
            ]
        );
    }

    public function setPiece(Piece $piece, Position $position): void
    {
        if ($position->row() > 3 || $position->column() > 3) {
            throw new InvalidArgumentException('Invalid position for this board');
        }

        if (!$this->value[$position->row() - 1][$position->column() - 1] instanceof NullPiece) {
            throw new InvalidArgumentException('Already a piece in this position');
        }

        $this->value[$position->row() - 1][$position->column() - 1] = $piece;
    }

    public function value(): array
    {
        return $this->value;
    }
}
