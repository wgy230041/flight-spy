#!/usr/bin/env php
<?php
/**
 * @author Jean Silva <jeancsil@gmail.com>
 * @license MIT
 */
require 'boot.php';

use Symfony\Component\Console\Application;
use Jeancsil\FlightSpy\Command\SkyscannerCommand;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$container = new ContainerBuilder();
$resourcesLocator = new \Symfony\Component\Config\FileLocator(__DIR__ . '/src/Resources');

$loader = new XmlFileLoader($container, $resourcesLocator);
$loader->load('services.xml');

$loader = new YamlFileLoader($container, $resourcesLocator);
$loader->load('parameters.yml');

$skyscanner = new SkyscannerCommand();
$skyscanner->setContainer($container);

$application = new Application();
$application->add($skyscanner);
$application->run();
