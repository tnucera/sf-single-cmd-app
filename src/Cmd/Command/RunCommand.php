<?php declare(strict_types = 1);

namespace Cmd\Command;

use Cmd\Service\ExampleService;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\VarDumper\VarDumper;

class RunCommand extends BaseCommand
{
    /**
     * @var ExampleService
     */
    protected $example;

    /**
     * RunCommand constructor.
     *
     * @param ExampleService $example
     */
    public function __construct(ExampleService $example)
    {
        parent::__construct(null);

        $this->example = $example;
    }


    /**
     * Configuration de la commande
     */
    protected function configure()
    {
        $this
            ->setName('run')
            ->setDescription("Run Barry, Run!");
    }

    /**
     * Exécution de la commande
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        parent::execute($input, $output);

        $this->example->show();

        return 0;
    }
}
