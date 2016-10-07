<?php

namespace Tests\Cmd\Unit\Service;

use Cmd\Service\ExampleService;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Console\Output\ConsoleOutput;

class ExampleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ConsoleOutput|ObjectProphecy
     */
    protected $consoleOutputProphecy;

    /**
     * @var ExampleService
     */
    protected $example;

    /**
     * Set up
     */
    protected function setUp()
    {
        parent::setUp();

        $this->consoleOutputProphecy = $this->prophesize(ConsoleOutput::class);

        $this->example = new ExampleService($this->consoleOutputProphecy->reveal(), "", []);
    }

    /**
     * @test
     * @group service
     * @expectedException \Cmd\Exception\CommandException
     */
    public function show()
    {
        $this->example->show();
    }
}
