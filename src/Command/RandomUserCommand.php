<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Model\RandomUserApi;

class RandomUserCommand extends Command
{
    protected static $defaultName = 'app:create-random-user';

    private $randomUserApi;

    public function __construct(
        RandomUserApi $randomUserApi
    ) {
        parent::__construct();

        $this->randomUserApi = $randomUserApi;
    }

    protected function configure(): void
    {
        $this
            // configure an argument in case we want to use param dynamic
            ->addArgument('seed', InputArgument::OPTIONAL, 'permet de figer les résultats retournés.')
            ->addArgument('results', InputArgument::OPTIONAL, "nombre d'utilisateurs retournés")
            ->addArgument('nat', InputArgument::OPTIONAL, 'pour limiter aux adresses françaises.')
            ->setDescription('Command to import user from api.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            '<info>Start import user from api save into database</>',
            '<info>==========================</>',
            '',
        ]);

        try {
            $this->randomUserApi->generateRandomUser((int)$input->getArgument('results'));
            $output->write('end command .');
            return Command::SUCCESS;
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return Command::FAILURE;
        }
    }
}
