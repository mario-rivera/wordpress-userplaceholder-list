<?php
if (file_exists(dirname(__DIR__,2) . '/vendor/autoload.php')) {
    require_once(dirname(__DIR__,2) . '/vendor/autoload.php');
}

if (!class_exists('WP')) {
    require_once(__DIR__ . '/wp.php');
}
