#!/usr/bin/env php
<?php

declare(strict_types = 1);

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

(new Application('tic-tac-toe', '1.0.0'))
    ->add(new \Acme\TicTacToe\PlayCommand())
    ->getApplication()
    ->run();
