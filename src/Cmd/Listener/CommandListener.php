<?php declare(strict_types = 1);

namespace Cmd\Listener;

use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Event\ConsoleExceptionEvent;
use Symfony\Component\Console\Event\ConsoleTerminateEvent;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\VarDumper\VarDumper;

class CommandListener
{
    /**
     * @param ConsoleCommandEvent $event
     */
    public function onConsoleCommand(ConsoleCommandEvent $event)
    {
        $output = $event->getOutput();

        $this->showLogo($output);
    }

    /**
     * Permet d'afficher directement l'exception et donc de connaître l'endroit dans la console où elle a été levée.
     * Par défaut l'exception en mode console est affichée à la fin.
     *
     * @param ConsoleExceptionEvent $event
     */
    public function onConsoleException(ConsoleExceptionEvent $event)
    {
        $command = $event->getCommand();
        $application = $command->getApplication();
        $exception = $event->getException();
        $output = $event->getOutput();

        if ($output instanceof ConsoleOutputInterface) {
            $output = $output->getErrorOutput();
        }

        $application->renderException($exception, $output);
    }

    /**
     * @param ConsoleTerminateEvent $event
     */
    public function onConsoleTerminate(ConsoleTerminateEvent $event)
    {
        $output = $event->getOutput();

        $output->writeln("<fg=cyan>Perform some actions on console terminate</>");

        $this->showLogo($output);
    }

    /**
     * Affiche le logo avec la version actuelle
     *
     * @param OutputInterface $output
     */
    protected function showLogo(OutputInterface $output)
    {
        $output->write("<fg=magenta;options=bold>");
        $output->writeln("   ______                                          __ ");
        $output->writeln("  / ____/___  ____ ___  ____ ___  ____ _____  ____/ / ");
        $output->writeln(" / /   / __ \/ __ `__ \/ __ `__ \/ __ `/ __ \/ __  /  ");
        $output->writeln("/ /___/ /_/ / / / / / / / / / / / /_/ / / / / /_/ /   ");
        $output->writeln("\____/\____/_/ /_/ /_/_/ /_/ /_/\__,_/_/ /_/\__,_/    ");
        $output->writeln("</>");
    }
}
