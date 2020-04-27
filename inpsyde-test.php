<?php
/**
 * Plugin Name: Custom Endpoint Inpsyde Test
 */

require_once __DIR__ . '/config/bootstrap.php';

$container = \Bootstrap\InpsydeTest\init();

$plugin = $container->get(\InpsydeTest\CustomEndpointPlugin::class);
$plugin->run();