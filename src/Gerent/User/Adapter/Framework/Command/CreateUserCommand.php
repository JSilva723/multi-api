<?php

declare(strict_types=1);

namespace Gerent\User\Adapter\Framework\Command;

use Gerent\User\Application\CreateUserService;
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
            ->addArgument('username', InputArgument::REQUIRED, 'User username')
            ->addArgument('password', InputArgument::REQUIRED, 'User password');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $username = $input->getArgument('username');
        $password = $input->getArgument('password');
        $this->createUserService->create($username, $password);
        $output->writeln(sprintf('User [%s] has been created', $username));

        return Command::SUCCESS;
    }
}
