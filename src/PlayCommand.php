<?php

declare(strict_types = 1);

namespace Acme\TicTacToe;

use Acme\TicTacToe\Game\Game;
use Acme\TicTacToe\Game\Position;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class PlayCommand extends Command
{
    protected function configure()
    {
        $this->setName('play');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Three in a row');

        $io = new SymfonyStyle($input, $output);

        $game = new Game();

        $game->init();
        $this->render($output, $game);

        while (!$game->isFinished()) {

            $player = $game->currentPlayer();

            $coordinates = $io->ask(
                sprintf('Player <comment>%s</comment>, where do you want to put your piece?', $player->name())
            );

            $explodedCoordinates = explode(',', $coordinates);
            $position            = new Position((int) $explodedCoordinates[0], (int) $explodedCoordinates[1]);

            $game->play($position);

            $game->nextMove();
            $this->render($output, $game);
        }

        return 0;
    }

    private function render(OutputInterface $output, Game $game): void
    {
        (new Table($output))
            ->setRows($game->board()->value())
            ->render();
    }


}
