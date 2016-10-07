<?php declare(strict_types = 1);

namespace Cmd\Service;

use Cmd\Exception\CommandException;
use Cmd\Helper\ArrayHelper;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\VarDumper\VarDumper;

class ExampleService
{
    /**
     * @var ConsoleOutput
     */
    protected $ouput;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var array
     */
    protected $array;

    /**
     * ExampleService constructor.
     *
     * @param ConsoleOutput $ouput
     * @param string $message
     * @param array $array
     */
    public function __construct(ConsoleOutput $ouput, string $message, array $array)
    {
        $this->ouput = $ouput;
        $this->message = $message;
        $this->array = $array;
    }

    public function show()
    {
        $this->ouput->writeln($this->message);
        $this->ouput->writeln("");
        $this->ouput->writeln(ArrayHelper::toString($this->array));
        throw new CommandException("Exception test");
    }
}
