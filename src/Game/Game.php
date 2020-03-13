<?php

declare(strict_types = 1);

namespace Acme\TicTacToe\Game;

use function Functional\flatten;
use function Functional\some;

final class Game
{
    private Board $board;

    private Player $currentPlayer;

    private Player $firstPlayer;

    private Player $secondPlayer;

    public function init(): void
    {
        $this->board = Board::initialize();

        $this->firstPlayer  = new Player('Player1', new CrossPiece());
        $this->secondPlayer = new Player('Player2', new CirclePiece());

        $this->currentPlayer = $this->firstPlayer;
    }

    public function board(): Board
    {
        return $this->board;
    }

    public function play(Position $position): void
    {
        $this->board->setPiece($this->currentPlayer->piece(), $position);
    }

    public function nextMove(): void
    {
        if ($this->currentPlayer === $this->firstPlayer) {
            $this->currentPlayer = $this->secondPlayer;
        } else {
            $this->currentPlayer = $this->firstPlayer;
        }
    }

    public function currentPlayer(): Player
    {
        return $this->currentPlayer;
    }

    public function isFinished(): bool
    {
        $isNotFull = some(
            flatten($this->board->value()),
            static function (Piece $value): bool{
                return $value instanceof NullPiece;
            }
        );

        return !$isNotFull;
    }
}
