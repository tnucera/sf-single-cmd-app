#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\EventDispatcher\DependencyInjection\RegisterListenersPass;

$container = new ContainerBuilder();
// Config
$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/config'));
$loader->load('config.yml');
// Param
$dispatcherId = $container->getParameter('dispatcher_id');

// CompilerPass
$container->addCompilerPass(new RegisterListenersPass($dispatcherId));
$container->setDefinition($dispatcherId, new Definition(
    'Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher',
    [new Reference('service_container')]
));
$container->compile();

$dispatcher = $container->get($dispatcherId);
$output = $container->get('symfony.console.output');

/** @var Symfony\Component\Console\Application $application */
$application = $container->get('cmd');
$application->setDispatcher($dispatcher);
$application->run(null, $output);
