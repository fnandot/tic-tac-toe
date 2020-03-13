<?php

declare(strict_types = 1);

namespace Acme\TicTacToe\Game;

use InvalidArgumentException;

final class Board
{
    private array $value;
    private int $dimensions;

    private function __construct(array $value, int $dimensions = 3)
    {
        $this->value = $value;
        $this->dimensions = $dimensions;
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
        if ($position->row() > $this->dimensions || $position->column() > $this->dimensions) {
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

    public function dimensions(): int
    {
        return $this->dimensions;
    }
}
