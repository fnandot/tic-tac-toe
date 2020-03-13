<?php

declare(strict_types=1);

namespace Acme\TicTacToe\Game;

use function Functional\flatten;
use function Functional\some;
use function Functional\unique;

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
        return $this->hasAWinner() || $this->isFull();
    }

    private function isFull(): bool
    {
        return !some(
            flatten($this->board->value()),
            static function (Piece $value): bool {
                return $value instanceof NullPiece;
            }
        );
    }

    private function hasAWinner(): bool
    {
        return $this->hasAWinningRow() || $this->hasAWinningColumn() || $this->hasAWinningDiagonal();
    }

    private function hasAWinningRow(): bool
    {
        return some(
            $this->board->value(),
            static::checkLine()
        );
    }

    private function hasAWinningColumn(): bool
    {
        return some(
            $this->transposeData($this->board->value()),
            static::checkLine()
        );
    }

    private function hasAWinningDiagonal(): bool
    {
        return $this->checkDiagonal($this->board()->value()) ||
               $this->checkDiagonal($this->transposeData($this->board()->value()));
    }

    private function transposeData(array $data): array
    {
        $retData = [];

        foreach ($data as $row => $columns) {
            foreach ($columns as $row2 => $column2) {
                $retData[$row2][$row] = $column2;
            }
        }

        return $retData;
    }

    private function checkDiagonal(array $elements): bool
    {
        $pieces = [];
        for ($rowIndex = 0; $rowIndex <= count($elements) - 1; $rowIndex++) {
            $pieces[0][] = $elements[$rowIndex][$rowIndex];
        }

        return some($pieces, self::checkLine());
    }

    private static function checkLine(): \Closure
    {
        return function (array $row): bool {
            $result = unique($row);
            return count($result) === 1 && !current($result) instanceof NullPiece;
        };
    }
}
