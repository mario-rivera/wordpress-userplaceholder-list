<?php
namespace Bootstrap\InpsydeTest;

function init(): \Psr\Container\ContainerInterface
{
    $builder = new \DI\ContainerBuilder();
    $builder->addDefinitions( __DIR__ . "/definitions.php");

    return $builder->build();
}
