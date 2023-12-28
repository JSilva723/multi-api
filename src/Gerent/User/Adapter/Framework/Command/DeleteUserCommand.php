<?php

namespace Gerent\User\Adapter\Framework\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteUserCommand extends Command
{
    public function configure(): void
    {
        $this
            ->setName('gerent:user:delete')
            ->setDescription('Remove an user from the gerent module')
            ->addArgument('id', InputArgument::REQUIRED, 'The user id');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $id = $input->getArgument('id');
        $output->writeln(sprintf('User with id [%s] has been deleted', $id));

        return Command::SUCCESS;
    }
}
