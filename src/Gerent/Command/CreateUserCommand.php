<?php

declare(strict_types=1);

namespace Gerent\Command;

use Gerent\Service\CreateUserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
    public function __construct(
        private readonly CreateUserService $createUserService
    ) {
        parent::__construct();
    }

    public function configure(): void
    {
        $this
            ->setName('gerent:user:create')
            ->setDescription('Create new user in the gerent module')
            ->addArgument('name', InputArgument::REQUIRED, 'User name')
            ->addArgument('password', InputArgument::REQUIRED, 'User password');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $password = $input->getArgument('password');
        $this->createUserService->create($name, $password);
        $output->writeln(sprintf('User [%s] has been created', $name));

        return Command::SUCCESS;
    }
}
