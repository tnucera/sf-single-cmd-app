<?php

namespace Tests\Cmd\Unit\Listener;

use Cmd\Listener\CommandListener;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Event\ConsoleExceptionEvent;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CommandListenerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CommandListener
     */
    protected $commandListener;

    /**
     * @before
     */
    protected function init()
    {
        $this->commandListener = new CommandListener();
    }

    /**
     * @test
     * @group listener
     */
    public function onConsoleCommand()
    {
        $event = $this->prophesize(ConsoleCommandEvent::class);
        $outputInterfaceProphecy = $this->prophesize(OutputInterface::class);

        $event->getOutput()->shouldBeCalledTimes(1)->willReturn($outputInterfaceProphecy->reveal());

        $this->commandListener->onConsoleCommand($event->reveal());
    }

    /**
     * @test
     * @group listener
     */
    public function onConsoleException()
    {
        $event = $this->prophesize(ConsoleExceptionEvent::class);
        $commandProphecy = $this->prophesize(Command::class);
        $consoleOutputInterfaceProphecy = $this->prophesize(ConsoleOutputInterface::class);
        $outputInterfaceProphecy = $this->prophesize(OutputInterface::class);
        $applicationProphecy = $this->prophesize(Application::class);
        $exceptionProphecy = $this->prophesize(\Exception::class);

        $event->getCommand()->shouldBeCalledTimes(2)->willReturn($commandProphecy->reveal());
        $commandProphecy->getApplication()->shouldBeCalledTimes(2)->willReturn($applicationProphecy->reveal());
        $event->getException()->shouldBeCalledTimes(2)->willReturn($exceptionProphecy->reveal());
        $event->getOutput()->shouldBeCalledTimes(2)->willReturn($consoleOutputInterfaceProphecy->reveal(), $outputInterfaceProphecy->reveal());
        $consoleOutputInterfaceProphecy->getErrorOutput()->shouldBeCalledTimes(1)->willReturn($outputInterfaceProphecy->reveal());
        $applicationProphecy->renderException($exceptionProphecy->reveal(), $outputInterfaceProphecy->reveal())->shouldBeCalledTimes(2);

        $this->commandListener->onConsoleException($event->reveal());
        $this->commandListener->onConsoleException($event->reveal());
    }

    /**
     * @test
     * @group listener
     */
    public function onConsoleTerminate()
    {
        $event = $this->prophesize(ConsoleCommandEvent::class);
        $outputInterfaceProphecy = $this->prophesize(OutputInterface::class);

        $event->getOutput()->shouldBeCalledTimes(1)->willReturn($outputInterfaceProphecy->reveal());

        $this->commandListener->onConsoleCommand($event->reveal());
    }
}
